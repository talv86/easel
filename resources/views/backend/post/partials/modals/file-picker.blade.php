<div class="modal fade" id="easel-file-picker" tabIndex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Image Selector</h4>
            </div>

            <div class="modal-body">

                <div id="easel-file-browser">

                    <div class="card-header">
                        <ol class="breadcrumb">

                            <li v-for="(path, name) in breadCrumbs">
                                <a href="javascript:void(0);" @click=loadFolder(path)>@{{ name }}</a>
                            </li>

                            <li>
                                <a href="javascript:void(0);">@{{ folderName }}</a>
                            </li>
                        </ol>
                    </div>

                    <div class="row">

                        {{-- Loader --}}
                        <div :class="{ 'col-sm-12' : !currentFile, 'col-sm-9' : currentFile }">
                            <div v-if="loading">
                                <div class="preloader pl-xxl" style="position: relative; left: 50%; margin-left: -25px; top: 50%;">
                                    <svg viewBox="25 25 50 50" class="pl-circular">
                                        <circle r="20" cy="50" cx="50" class="plc-path"/>
                                    </svg>
                                </div>
                            </div>

                            <div v-else>

                                <div class="table-responsive">
                                    <table class="table table-condensed table-vmiddle">

                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <tr v-for="(path, folder) in folders">
                                            <td>
                                                <i class="zmdi zmdi-folder-outline"></i>
                                                <a href="javascript:void(0);" @click="loadFolder(path)" class="word-wrappable"
                                                >@{{ folder }}</a>
                                            </td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>

                                        <tr v-for="file in files">
                                            <td>
                                            <span v-if="isImage(file)">
                                                <i class="zmdi zmdi-image"></i>
                                                <a href="javascript:void(0);" @click="previewImage(file)" @dblclick="selectFile(file)" class="word-wrappable">@{{ file.name }}</a>
                                            </span>

                                                <span v-else>
                                                <i class="zmdi zmdi-file-text"></i>
                                                <a href="javascript:void(0);" @dblclick="selectFile(file)" class="word-wrappable">@{{ file.name }}</a>
                                            </span>
                                            </td>
                                            <td> @{{ file.mimeType }} </td>
                                            <td> @{{ file.modified.date | moment 'L LTS' }}</td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>


                        <div :class="{ 'hidden-xs' : !currentFile, 'col-sm-3' : currentFile }" v-show="currentFile">

                            <h4>Preview</h4>
                            <a href="@{{ currentFile.webPath }}" target="_blank">
                                <img id="easel-preview-image" class="img-responsive thumbnail" :src="currentFile.webPath"/>
                                <p class="text-center">
                                    <strong style="word-wrap: break-word">@{{ currentFile.name }}</strong>
                                </p>
                            </a>

                        </div>
                    </div>

                    @if (config('app.debug') )
                        <pre>@{{ $data | json }}</pre>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
