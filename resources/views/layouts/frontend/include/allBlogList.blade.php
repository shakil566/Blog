<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    <h1 class="header margin-bottom-10">ALL Blogs </h1>
    <div class="row">
        @if (!empty($targetArr))
            <?php
            $sl = 0;
            ?>
            @foreach ($targetArr as $target)
                <?php
                ?>
                <div class="col-md-3">
                    <div class="contact-box center-version">
                        <a>

                            <address class="m-t-md">
                                <strong>Title </strong>


                                <br>
                                {!! $target->title ?? '' !!}
                                <br>
                                <br>
                                <strong>Description </strong><br>
                                {!! $target->description ?? '' !!}
                            </address>
                            <a class="btn btn-primary btn-sm create-new" title="Comment"
                                href="{{ URL::to('/blog-comment').'/'.$target->id.'/' . $target->slug }}"> Comment
                                <i class="fa fa-plus create-new"></i>
                            </a>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
