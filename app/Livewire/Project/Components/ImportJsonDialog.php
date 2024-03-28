<?php

namespace App\Livewire\Project\Components;

use Livewire\Component;
use App\Models\Content;

class ImportJsonDialog extends Component
{
    // props
    public $showImportDialog;
    public $project_id;

    // rule
    protected $rules = [
        'importData' => 'required',
        'importLang' => 'required',
        'importIsCovered' => 'required',
    ];

    // data
    public $importData = [];
    public $importLang = 'en_US';
    public $importIsCovered = 0;

    public function submit()
    {
        $this->validate();
        // check format is json
        if ($this->__isJson($this->importData)) {
            $json = json_decode($this->importData, 320);
            foreach($json as $key => $word) {
                $content = Content::where('project_id', $this->project_id)
                    ->where('key', $key)
                    ->firstOrNew(['project_id' => $this->project_id, 'key' => $key]);

                if ($this->importIsCovered) {
                    $content[$this->importLang] = $word;
                } else {
                    if ($content[$this->importLang] === NULL) $content[$this->importLang] = $word;
                }
                $content->save();
            }

            $this->dispatch('closeImportDialog');
        }
    }

    private function __isJson($string) {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function render()
    {
        return view('livewire.project.components.import-json-dialog');
    }
}
