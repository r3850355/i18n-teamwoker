<x-dialog :ref="'showImportDialog'">
  <div
    class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
    {{-- importData --}}
    <div class="mt-2">
      <label for="importData" class="block text-sm font-medium leading-6 text-gray-900">匯入json格式
      </label>
      <div class="mt-2">
        <textarea rows="4" wire:model="importData" name="importData" id="importData"
          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
      </div>
    </div>

    {{-- 語言 --}}
    <div class="mt-3">
      <label class="text-sm font-medium text-gray-900">選擇要輸入的語言</label>
      <fieldset class="mt-4">
        <legend class="sr-only">語言</legend>
        <div class="space-y-4 sm:flex sm:items-center sm:space-x-10 sm:space-y-0">
          <div class="flex items-center">
            <input id="enus" type="radio" wire:model="importLang" value="en_US"
              class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
            <label for="enus" class="ml-3 block text-sm font-medium leading-6 text-gray-900">en_US</label>
          </div>
          <div class="flex items-center">
            <input id="zhtw" type="radio" wire:model="importLang" value="zh_TW"
              class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
            <label for="zhtw" class="ml-3 block text-sm font-medium leading-6 text-gray-900">zh_TW</label>
          </div>
          <div class="flex items-center">
            <input id="zhcn" type="radio" wire:model="importLang" value="zh_CN"
              class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
            <label for="zhcn" class="ml-3 block text-sm font-medium leading-6 text-gray-900">zh_CN</label>
          </div>
          <div class="flex items-center">
            <input id="jajp" type="radio" wire:model="importLang" value="ja_JP"
              class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
            <label for="jajp" class="ml-3 block text-sm font-medium leading-6 text-gray-900">ja_JP</label>
          </div>
        </div>
      </fieldset>
    </div>

    {{-- 覆蓋 --}}
    <div class="mt-3">
      <label class="text-sm font-medium text-gray-900">若有重複是否覆蓋原有的內容?</label>
      <fieldset class="mt-4">
        <legend class="sr-only">是否覆蓋?</legend>
        <div class="space-y-4 sm:flex sm:items-center sm:space-x-10 sm:space-y-0">
          <div class="flex items-center">
            <input id="cover_false" type="radio" wire:model="importIsCovered" value="0"
              class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
            <label for="cover_false" class="ml-3 block text-sm font-medium leading-6 text-gray-900">略過</label>
          </div>
          <div class="flex items-center">
            <input id="cover_true" type="radio" wire:model="importIsCovered" value="1"
              class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
            <label for="cover_true" class="ml-3 block text-sm font-medium leading-6 text-gray-900">覆蓋</label>
          </div>
        </div>
      </fieldset>
    </div>

    {{-- 按鈕 --}}

    <div class="mt-5 sm:mt-6">
      <button type="button" wire:click="submit()"
        class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">匯入</button>
    </div>
    <div class="mt-2 sm:mt-2">
      <button type="button" x-on:click="showImportDialog = false"
        class="inline-flex w-full justify-center rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">取消</button>
    </div>
  </div>
</x-dialog>
