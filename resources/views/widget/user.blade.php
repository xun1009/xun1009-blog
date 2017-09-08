<div class="widget widget-user" style="overflow: hidden">
    <?php
    if (isset($profile_image) && $profile_image)
        $style = "background: url($profile_image) center center;";
    else
        $style = "background-color: #52768e;";
    ?>
    <div class="widget-user-header" style="{{ $style }}">
        <h3 class="widget-user-username">{{ $user->name or 'Author' }}</h3>
        <h5 class="widget-user-desc">{{ $settings['description'] or 'Description' }}</h5>
    </div>
    <div class="widget-user-image">
        <img class="img-circle" src="{{ $user->avatar or 'https://raw.githubusercontent.com/lufficc/images/master/Xblog/logo.png' }}" alt="User Avatar">
    </div>
    <div class="widget-user-footer">
        <div class="row">
            <div class="col-xs-6 border-right center-block">
                <div class="description-block">
                    <a href="{{ $settings['weibo'] }}" title="" class="description-header"><i
                                class="{{ 'fa fa-weibo fa-lg' }}"
                                aria-hidden="true"></i></a>
                </div>
            </div>

            <div class="col-xs-6 border-right center-block">
                <div class="description-block">
                    <a href="{{ $settings['github'] }}" title="" class="description-header"><i
                                class="{{ 'fa fa-github fa-lg' }}"
                                aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>