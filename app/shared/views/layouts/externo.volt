<header id="header" class="clearfix" data-current-skin="green">
    <ul class="header-inner">
        <li class="logo">
            <a href="{{ static_url() }}">
                <img src="{{ static_url('assets/img/logo.jpg') }}" alt="{{ titleLogo }}" title="{{ titleLogo }}" class="img-responsive img-thumbnail" />
                <h1 class="text-hide hide">{{ titleLogo }}</h1></a>
        </li>
    </ul>
</header>

<section style="top: 90px; position: relative;">
    <div class="container">
        {{ flash.output() }}
        {{ content() }}
    </div>
</section>