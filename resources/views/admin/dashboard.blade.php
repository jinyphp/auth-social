@setTheme("admin.sidebar")
<x-theme name="admin.sidebar">
    <x-theme-layout>

        <div class="row">
            <x-col-left class="col-md-10">
                <div class="mb-3">
                    <h1 class="h3 d-inline align-middle">소셜로그인</h1>
                    <p>소셜 로그인 가입된 회원을 관리합니다.</p>
                </div>
            </x-col-left>
            <x-col-right class="col-md-2 d-flex justify-content-end align-items-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Admin</a></li>
                      <li class="breadcrumb-item"><a href="#">Modules</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Social</li>
                    </ol>
                </nav>
            </x-col-right>
        </div>

        <div class="row">
            <div class="col-12 col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">
                                    <a href="/admin/auth/provider">소셜연동</a>
                                </h5>
                            </div>
                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16">
                                        <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
                                        <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        @foreach (social_login_all() as $item)
                        <div class="badge bg-primary my-2">{{$item}}</div>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">
                                    <a href="/admin/auth/oauth">소셜가입</a>
                                </h5>
                            </div>
                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16">
                                        <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
                                        <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>





    </x-theme-layout>
</x-theme>
