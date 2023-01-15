@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Hello {{ Auth::user()->name }}</h1>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <a href="contact/">
                            <div class="card-icon">
                                <i class="fa fa-user"></i>
                            </div>
                        </a>
                        <p class="card-category">Total User</p>
                        <h3 class="card-title">{{ $totalUser ?? '' }}
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-danger"></i>
                            <a href="javascript:;"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <a href="contact/favourite">
                            <div class="card-icon">
                                <i class="fa fa-bookmark"></i>
                            </div>
                        </a>
                        <p class="card-category">Total Blog</p>
                        <h3 class="card-title">{{ $totalBlog ?? '' }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php
    echo 'Solution 1:';
    echo '<br>';
    $a = 5;
    $b = 10;
    echo 'Initially: ';
    echo 'a = ' . $a . ' and ';
    echo 'b =' . $b;
    $a = $a + $b;
    $b = $a - $b;
    $a = $a - $b;
    echo '   After swap: ';
    echo 'a = ' . $a . ' and ';
    echo 'b =' . $b;



    echo '<br>';
    echo '<br>';
    echo 'Solution 2:';
    echo '<br>';
    $n = 5;
    for ($i = 1; $i <= $n; $i++) {
        for ($j = 1; $j <= $n; $j++) {
            if ($j > $n - $i) {
                echo '#';
            } else {
                echo ' ';
            }
        }
        echo '<br>';
    }

    ?>
@endsection
