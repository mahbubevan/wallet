<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    {{-- font awesome --}}
    <script src="https://kit.fontawesome.com/bda171beb6.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}" rel="stylesheet">
    <title>Welcome</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{route('landing')}}">Wallet <span class="ml-3"><i class="fas fa-wallet"></i></span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link text-white" href="{{route('landing')}}">Home <span class="ml-2"><i class="fas fa-home"></i></span><span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#features">Why choose us ? <span class="ml-2"><i class="far fa-address-card"></i></span></a>
            </li>  
            <li class="nav-item">
                <a class="nav-link text-white" href="#about">About <span class="ml-2"><i class="far fa-address-card"></i></span></a>
              </li>   
              @if (Route::has('user.login'))             
                  @auth
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('user.home') }}">User Dashboard <span class="ml-2"><i class="fas fa-user"></i></span></a>
                    </li>
                  @else
                  <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('user.login')}}">Login <span class="ml-2"><i class="far fa-user"></i></span></a>
                  </li>
                      @if (Route::has('user.register'))
                      <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('user.register')}}">Registration <span class="ml-2"><i class="fas fa-sign-out-alt"></i></span></a>
                      </li>
                      @endif
                  @endauth
                  @if(!auth()->guard('admin')->user())
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.login') }}">Admin Login <span class="ml-2"><i class="fas fa-user-shield"></i></span></a>
                    </li>
                  @else
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">Admin Dashboard<span class="ml-2"><i class="fas fa-lock-open"></i></span></a>
                    </li>
                  @endif       
          @endif
          </ul>
        </div>
        </div>
      </nav>
      
      <section class="">
        {{-- <div class="jumbotron jumbotron-fluid text-white h-100">
            <div class="container">
              <div class="">
                <p class="lead alert alert-success w-50">Transfer Money Worldwide In A Moment <span><i class="far fa-paper-plane"></i></span> </p>
                <p class="lead alert alert-danger w-50">We Ensure Secure Transfer <span class="ml-3"><i class="fas fa-user-secret"></i></span> </p>
                <p class="lead alert alert-success w-50">Transfer Money Worldwide In A Moment <span><i class="far fa-paper-plane"></i></span> </p>
                <p class="lead alert alert-danger w-50">We Ensure Secure Transfer <span class="ml-3"><i class="fas fa-user-secret"></i></span> </p>
              </div>
            </div>
          </div> --}}
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="assets/img/slider3.jpg" height="900px" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                  <h5><p class="lead alert alert-success w-50">Transfer Money Worldwide In A Moment <span><i class="far fa-paper-plane"></i></span> </p>
                    <p class="lead alert alert-danger w-50">We Ensure Secure Transfer <span class="ml-3"><i class="fas fa-user-secret"></i></span> </p>
                    <p class="lead alert alert-success w-50">Transfer Money Worldwide In A Moment <span><i class="far fa-paper-plane"></i></span> </p>
                    <p class="lead alert alert-danger w-50">We Ensure Secure Transfer <span class="ml-3"><i class="fas fa-user-secret"></i></span> </p>
                  </h5>
                  <p>...</p>
                </div>
              </div>


              <div class="carousel-item">
                <img class="d-block w-100 h-50" src="assets/img/slider2.jpg" height="900px" alt="Second slide">
                <div class="carousel-caption d-none d-md-block justify-content-center">
                  <h5><p class="lead alert alert-success w-50">Transfer Money Worldwide In A Moment <span><i class="far fa-paper-plane"></i></span> </p>
                    <p class="lead alert alert-danger w-50">We Ensure Secure Transfer <span class="ml-3"><i class="fas fa-user-secret"></i></span> </p>
                    <p class="lead alert alert-success w-50">Transfer Money Worldwide In A Moment <span><i class="far fa-paper-plane"></i></span> </p>
                    <p class="lead alert alert-danger w-50">We Ensure Secure Transfer <span class="ml-3"><i class="fas fa-user-secret"></i></span> </p>
                  </h5>
                  <p>...</p>
                </div>
              </div>

              <div class="carousel-item">
                <img class="d-block w-100 h-50" src="assets/img/jumbotron.jpg" height="900px" alt="Third slide">
                <div class="carousel-caption d-none d-md-block justify-content-center">
                  <h5><p class="lead alert alert-success w-50">Transfer Money Worldwide In A Moment <span><i class="far fa-paper-plane"></i></span> </p>
                    <p class="lead alert alert-danger w-50">We Ensure Secure Transfer <span class="ml-3"><i class="fas fa-user-secret"></i></span> </p>
                    <p class="lead alert alert-success w-50">Transfer Money Worldwide In A Moment <span><i class="far fa-paper-plane"></i></span> </p>
                    <p class="lead alert alert-danger w-50">We Ensure Secure Transfer <span class="ml-3"><i class="fas fa-user-secret"></i></span> </p>
                  </h5>
                  <p>...</p>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
      </section>

      <section id="features" class="container p-5 mb-5 text-justify">
            <h3 class="card-title text-center text-success">Why choose us ?</h3>  
            <div class="row mt-3 mb-3">
                <div class="col">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <h5 class="card-title text-center text-success"> 24/7 Support <i class="fas fa-headset"></i></h5>
                        <div class="card-body">
                            <p>
                                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. 
                              </p>
                        </div>
                      </div>
                </div>
                <div class="col">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" >
                        <h5 class="card-title text-center text-success">Secure Payment <i class="fas fa-mask"></i></h5>
                        <div class="card-body">
                            <p>
                                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. 
                              </p>
                        </div>
                      </div>
                </div>
                <div class="col">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" >
                        <h5 class="card-title text-center text-success">Easy Withdraw <i class="fas fa-money-bill"></i></h5>
                        <div class="card-body">
                            <p>
                                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. 
                              </p>
                        </div>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" >
                        <h5 class="card-title text-center text-success">Clean Transaction Log <i class="fas fa-columns"></i></h5>
                        <div class="card-body">
                            <p>
                                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. 
                              </p>
                        </div>
                      </div>
                </div>
                <div class="col">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded " >
                        <h5 class="card-title text-center text-success">Multiple Language Support <i class="fas fa-language"></i></h5>
                        <div class="card-body">
                            <p>
                                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. 
                              </p>
                        </div>
                      </div>
                </div>
                <div class="col">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded" >
                        <h5 class="card-title text-center text-success">Multiple Currency Support <i class="fas fa-dollar-sign"></i></h5>
                        <div class="card-body">
                          <p>
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. 
                          </p>
                        </div>
                      </div>
                </div>
            </div>
      </section>

      <section id="about" class="container ">
        {{-- <h6 class="display-4 text-center text-info"><u>About Us</u></h6> --}}
        <div class="row">
            <div class="col">
                <div class="card shadow-lg p-5 mb-5 mt-5 bg-white rounded text-justify" >
                    <h3 class="card-title text-center text-success">About us </h3>
                    <div class="card-body">
                        <p>
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. 
                          </p>
                          <p>
                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                          </p>
                          <p>
                            t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                          </p>
                    </div>
                  </div>
            </div>
        </div>  
      </section>

      <section id="footer" class="bg-dark">
          <footer class="p-5 mt-2">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col">
                          <h2 class="text-white"><u>Company</u></h2>
                        <ul class="list-group list-group-flush ">
                            <li class="list-group-item bg-dark text-white">Cras justo odio</li>
                            <li class="list-group-item bg-dark text-white">Dapibus ac facilisis in</li>
                            <li class="list-group-item bg-dark text-white">Morbi leo risus</li>
                            <li class="list-group-item bg-dark text-white">Porta ac consectetur ac</li>
                            <li class="list-group-item text-white bg-dark">Vestibulum at eros</li>
                          </ul>
                          
                      </div>
                      <div class="col">
                        <h2 class="text-white"><u>Our Expertise</u></h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-dark text-white">Cras justo odio</li>
                            <li class="list-group-item bg-dark text-white">Dapibus ac facilisis in</li>
                            <li class="list-group-item bg-dark text-white">Morbi leo risus</li>
                            <li class="list-group-item bg-dark text-white">Porta ac consectetur ac</li>
                            <li class="list-group-item text-white bg-dark">Vestibulum at eros</li>
                          </ul>
                          
                      </div>
                      <div class="col">
                        <h2 class="text-white"><u>Contact Us</u></h2>
                                <div id="response"></div>
                                <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-dark text-white">
                                    <input id="name" type="text" class="form-control" placeholder="Name" name="name @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                        <span id="name_error" class="text-danger"> {{$name_error??''}} </span>
                                
                                </li>
                                <li class="list-group-item bg-dark text-white">
                                    <input id="from" type="email" class="form-control" placeholder="some@someone.com" name="from">
                                    @error('from')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span id="from_error" class="text-danger"> {{$from_error??''}} </span>
                                </li>
                                <li class="list-group-item bg-dark text-white">
                                    <input type="text" id="subject" class="form-control" placeholder="subject" name="subject">
                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span id="subject_error" class="text-danger"> {{$subject_error??''}} </span>
                                </li>
                                <li class="list-group-item bg-dark text-white">
                                    <textarea name="body" id="body" id="" class="form-control" cols="30" rows="5" placeholder="Your Message"></textarea>
                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span id="about_error" class="text-danger"> {{$about_error??''}} </span>
                                </li>
                                <li class="list-group-item bg-dark text-white">
                                    <button id="submit_button" type="submit" class="btn btn-md btn-outline-success justify-content-end">Send<span class="ml-1"><i class="far fa-paper-plane"></i></span></button>
                                </li>
                                </ul>             
                      </div>
                  </div>
              </div>
              <div class="text-white text-center mt-5 p-5">Copyright My Wallet</div>
          </footer>
      </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }   
        });

    // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
    $("#submit_button").click(function(){

                         // console.log('submit');
        var name = document.getElementById("name").value;
        var from = document.getElementById("from").value;
        var subject = document.getElementById("subject").value;
        var body = document.getElementById("body").value;
        // console.log(name)
        $.ajax({
            url: "/wallet/send_public",
            type:'post',
            data: {
                name:name,
                from:from,
                subject:subject,
                body:body,
            },
            success: function( result ) {
              var error = {};
                if(result.errors)
                {
                    error = {
                        name:result.errors.name,
                        from:result.errors.from,
                        subject:result.errors.subject,
                        body:result.errors.body,
                    }

                    if(error.name !== undefined)
                    {
                      var name_error = `<div><span class="text-danger">${error.name}</span></div>`
                      $("#name_error").html(name_error)
                    }
                    if(error.from !== undefined)
                    {
                      var from_error = `<div><span class="text-danger">${error.from}</span></div>`
                      $("#from_error").html(from_error)
                    }
                    if(error.subject !== undefined)
                    {
                      var subject_error = `<div><span class="text-danger">${error.subject}</span></div>`
                      $("#subject_error").html(subject_error)
                    }
                   if(error.body !== undefined)
                    {
                      var body_error = `<div><span class="text-danger">${error.body}</span></div>`
                      $("#body_error").html(body_error)
                    }
                  }
                  else{
                    var response = `<span class="text-success">${result.message}</span>`
                    console.log(error);
                    $("#name_error").hide()
                    $("#from_error").hide()
                    $("#subject_error").hide()
                    $("#body_error").hide()
                    $("#response").html(response);
                  }
            
              }
            })
          
        })
      })
    
    </script>
  </body>
</html>
    