<x-www-app>
    <main>
        <div class="pattern-square"></div>
        <!--Pageheader start-->
        <section class="py-5 py-lg-8">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 offset-xl-4 col-md-12 col-12">
                        <div class="text-center">
                            <a href="index">
                                <img src="/assets/images/logo/brand-icon.svg" alt="brand" class="mb-3" /></a>
                            <h1 class="mb-1">Welcome Back</h1>
                            <p class="mb-0">
                                Don’t have an account yet?
                                <a href="/regist" class="text-primary">Register here</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

                <!--Sign up start-->
        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-lg-6 col-md-8 col-12">
                        <div class="card shadow-sm mb-6">
                            <div class="card-body">

                                {{-- OAuth 소셜 로그인--}}
                                @livewire('WireSocial-Login')


                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <div class="small mb-3 mb-lg-0 text-body-tertiary">
                                Copyright ©
                                <span class="text-primary"><a href="#">JinyPHP</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Sign up end-->






    </main>
</x-www-app>

