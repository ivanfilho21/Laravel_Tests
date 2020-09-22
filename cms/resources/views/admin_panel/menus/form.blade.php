@extends('adminlte::page')

@section('title', __('titles.menus'))

@section('content_header')
    <h1>{{ __('titles.menus') }}</h1>
@endsection

@section('content')
    @if (session('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i>{{ __('util.alert') }}</h5>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ $formRoute }}" method="post">
        @csrf
        @if ($editMode)
            @method('PUT')
        @endif

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="col-form-label">{{ __('attribs.name') }}:</label>
                    <input type="text" name="name" id="" value="{{ old('name', $menu->name ?? '') }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="menu_page">
                    <label class="col-form-label">{{ __('attribs.page') }}:</label>

                    <div class="input-group input-group-md">
                        <div class="input-group-prepend">
                            <select name="page_type" class="form-control bg-primary" onchange="selectPageType(this)">
                                <option value="0">{{ __('attribs.from_website') }}</option>
                                <option value="1">{{ __('attribs.external') }}</option>
                            </select>
                        </div>

                        <select name="page_site" class="form-control @error('page_site') is-invalid @enderror">
                        @foreach ($pages as $k => $page)
                            <option value="{{ $k }}">{{ $page->title }}</option>
                        @endforeach
                        </select>

                        <input type="text" name="page_url" value="{{ old('page_url', $menu->page_url ?? '') }}" class="form-control @error('page_url') is-invalid @enderror">
                    </div>

                    <div class="mb-3">
                        @error('page_site')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        @error('page_url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="submenu_switcher">
                    <label class="custom-control-label" for="submenu_switcher">{{ __('attribs.submenu') }}</label>
                </div>

                <div class="submenu">
                    <div class="submenus mb-2"></div>

                    <button class="btn btn-primary btn-sm" onclick="return addSubmenuRow()">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
               
            </div>

            <div class="card-footer text-center">
                <button type="submit" class="btn btn-success">{{ __('util.save') }}</button>
            </div>
        </div>
    </form>

    <script>
        var select = document.querySelector('select[name=page_type]')
        let pages = {{ $pages }}

        if (pages.length == 0) {
            document.querySelector('select[name=page_site]').disabled = true
            select.selectedIndex = 1
        }

        selectPageType()

        function selectPageType() {
            switch (select.selectedIndex) {
                case 0:
                    document.querySelector('select[name=page_site]').style.display = 'block'
                    document.querySelector('input[name=page_url]').style.display = 'none'
                    break;
                case 1:
                    document.querySelector('select[name=page_site]').style.display = 'none'
                    document.querySelector('input[name=page_url]').style.display = 'block'
                    break;
            }
        }


        // Colocar listener no switcher
        var switcher = document.querySelector('#submenu_switcher');

        switcher.addEventListener('click', checkSubmenu)

        checkSubmenu()

        function checkSubmenu() {
            document.querySelector('.menu_page').style.display = switcher.checked ? 'none' : 'block'
            document.querySelector('.submenu').style.display = switcher.checked ? 'block' : 'none'
        }

        var submenus = []

        function addSubmenuRow() {
            let eSubmenus = document.querySelector('div.submenus')
            let index = submenus.length

            let eSubmenu = document.createElement('div')
            let eSubmenuPre = document.createElement('div')
            let eSubmenuSelect = document.createElement('select')
            let eSubmenuPost = document.createElement('div')
            let eSubmenuPostButton = document.createElement('button')

            eSubmenu.className = 'submenu input-group input-group-sm mt-3'
            eSubmenuPre.className = 'input-group-prepend'
            eSubmenuPre.innerHTML = `<span class="input-group-text">${index}</span>`
            eSubmenuPost.className = 'input-group-append'
            eSubmenuPostButton.className = 'btn btn-danger'
            eSubmenuPostButton.innerHTML = `<i class="fa fa-minus"></i>`
            eSubmenuPostButton.setAttribute('data-index', `${index}`)
            eSubmenuPostButton.setAttribute('onclick', 'return removeSubmenuRow(this)')
            eSubmenuPost.appendChild(eSubmenuPostButton)
            eSubmenu.appendChild(eSubmenuPre)
            eSubmenu.appendChild(eSubmenuSelect)
            eSubmenu.appendChild(eSubmenuPost)

            submenus[index] = index
            eSubmenus.appendChild(eSubmenu)

            console.log(submenus)

            return false
        }

        // Bug no delete
        function removeSubmenuRow(elem) {
            if (! elem) {
                return false
            }

            let index = elem.dataset.index;
            let all = document.querySelectorAll('.submenus .submenu')

            console.log(index)

            if (index) {
                for (let sub of all) {
                    let i = sub.querySelector('button').dataset.index

                    if (i && i == index) {
                        sub.remove()
                    }
                }
            }
            console.log('rem ', index)
            console.log(submenus)
            return false
        }
    </script>
@endsection