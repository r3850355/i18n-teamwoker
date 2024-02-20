@section('title', 'Project List')

<div class="px-4 sm:px-6 lg:px-8" x-data="{ showDialog: @entangle('showDialog'), showDeleteDialog: @entangle('showDeleteDialog') }">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-base font-semibold leading-6 text-gray-900">專案</h1>
      <p class="mt-2 text-sm text-gray-700">這裡顯示目前所有專案的列表</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
      <button type="button" wire:click="create()"
        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">建立新專案</button>
    </div>
  </div>
  <div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <table class="min-w-full divide-y divide-gray-300">
          <thead>
            <tr>
              <th scope="col" class="py-3.5 pl-3 pr-4"></th>
              <th scope="col" class="px-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">名稱</th>
              <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">描述</th>
              <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                <span class="sr-only">編輯</span>
              </th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach ($this->projects as $project)
              <tr wire:key="project.id">
                <td>
                  <button type="button" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">選擇</button>
                </td>
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                  {{ $project->name }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $project->description }}</td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                  <a href="#" class="text-indigo-600 hover:text-indigo-900"
                    wire:click="select({!! $project->id !!})">修改<span class="sr-only">,
                      {{ $project->name }}</span></a>
                  <a href="#" class="pl-2 text-red-400 hover:text-red-700"
                    wire:click="selectDelete({!! $project->id !!})">刪除<span class="sr-only">,
                      {{ $project->name }}</span></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- DIALOG --}}
  <x-dialog :ref="'showDialog'">
    <div
      class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
      <div wire:key="name">
        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">名稱</label>
        @if (!$errors->has('selectedData.name'))
          <div class="mt-2">
            <input wire:model="selectedData.name" name="name" id="name"
              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        @else
          <div class="relative mt-2 rounded-md shadow-sm">
            <input wire:model="selectedData.name" name="name" id="name"
              class="block w-full rounded-md border-0 py-1.5 pr-10 text-red-900 ring-1 ring-inset ring-red-300 placeholder:text-red-300 focus:ring-2 focus:ring-inset focus:ring-red-500 sm:text-sm sm:leading-6"
              aria-invalid="true" aria-describedby="email-error">
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
              <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                  clip-rule="evenodd" />
              </svg>
            </div>
          </div>
          <p class="mt-2 text-sm text-red-600" id="name-error">名稱為必填，最少四個字元</p>
        @endif

      </div>
      <div wire:key="description">
        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">描述</label>
        <div class="mt-2">
          <input wire:model="selectedData.description" name="description" id="description"
            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>
      <div class="mt-5 sm:mt-6">
        <button type="button" wire:click="submit()"
          class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">儲存</button>
      </div>
      <div class="mt-2 sm:mt-2">
        <button type="button" x-on:click="showDialog = false"
          class="inline-flex w-full justify-center rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">取消</button>
      </div>
    </div>
  </x-dialog>

  {{-- DELETE DIALOG --}}
  <x-dialog :ref="'showDeleteDialog'">
    <div
      class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
      <div class="sm:flex sm:items-start">
        <div
          class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
          <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
          </svg>
        </div>
        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
          <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">確認要將這個專案刪除？</h3>
          <div class="mt-2">
            <p class="text-sm text-gray-500">此操作將會連同專案底下的所有翻譯檔案一同刪除，刪除後將無法復原</p>
          </div>
        </div>
      </div>
      <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
        <button type="button" wire:click="delete()"
          class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">確認刪除</button>
        <button type="button" x-on:click="showDeleteDialog = false"
          class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">取消</button>
      </div>
    </div>
  </x-dialog>
</div>
