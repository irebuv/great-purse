<div class="row">
    <div class="col-xl-8 col-lg-12 offset-xl-2 offset-lg-0 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <a wire:navigate href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add Category</a>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10%" class="text-center">ID</th>
                            <th style="width: 60%">Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {!! \App\Helpers\Category\Category::getMenu('incs.menu-table-tpl') !!}
                    </tbody>
                </table>
                </div>
                
            </div>
        </div>
    </div>
</div>