<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="{{ asset('templet/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('templet/vendor/chartist/css/chartist.min.css') }}">
	<!-- Datatable -->
    <link href="{{ asset('templet/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('templet/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('templet/css/style.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('./images/logo.jpg')}}"  alt="">
                <img class="logo-compact" src="./images/logo-text.png" alt="">
                <img class="brand-title" src="./images/logo-text.png" alt="">
            </a>

           <!-- <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>-->
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
		
		
		<!--**********************************
            Header start
        ***********************************-->
    <!-- <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                <form action="/search" method="get" role="search">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="input-group search-area d-lg-inline-flex d-none">
									<input type="text" class="form-control" name="search" placeholder="Search here...">
								
										<span class="input-group-prepend">
                                            <button class="input-group-text"><i class="flaticon-381-search-2"></i></button>
                                        </span>
									
                                </form>
								</div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>  -->
        </div>
      

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					
							<span class="nav-text">Users Managment</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="{{ URL('members') }}"> User</a></li>
                            <li><a href="{{ URL('createmember') }}"> Add User</a></li>
						
						</ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					
							<span class="nav-text">Chalet Managment</span>
						</a>
                        <ul aria-expanded="false">
                        <li><a href="{{ URL('chalets') }}">Chalets</a></li>
                        <li><a href="{{ URL('createchalet') }}">Add Chalet</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                   
                        <span class="nav-text">Comment Managment</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ URL('comments') }}">Chalet Comments</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                
                    <span class="nav-text">Rate Managment</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ URL('rates') }}">Chalet Rates</a></li>
                </ul>
            </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
               
                <span class="nav-text">Reservation Managment</span>
            </a>
            <ul aria-expanded="false">
                <li><a href="{{ URL('reservations') }}">Chalet Reservation</a></li>
                <li><a href="{{ URL('createreservation') }}">Add Reservation</a></li>
            </ul>
        </li>
        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
               
            <span class="nav-text">Services Managment</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{ URL('creatrservices') }}">Add Service</a></li>
            <li><a href="{{ URL('services') }}">Services</a></li>
        </ul>
    </li>
    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
               
        <span class="nav-text">Details Managment</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{ URL('creatrdetail') }}">Add Detail</a></li>
        <li><a href="{{ URL('details') }}">Details</a></li>
    </ul>
</li>
      <!--  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
               
            <span class="nav-text">Prices Managment</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="{{ URL('prices') }}">Chalet Price</a></li>
        </ul>
    </li>  -->  
                
                  
                   
                  
                
                    
                   
                    
                </ul>
              
				
			</div>
        </div>
        
        @yield('content')
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
   

   
       
    
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->
       

    </div>

   
    

    <script src="{{ asset('templet/vendor/global/global.min.js') }}"></script>
	<script src="{{ asset('templet/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('templet/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('templet/js/custom.min.js') }}"></script>
	<script src="{{ asset('templet/js/deznav-init.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('templet/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script>
		(function($) {
			var table = $('#example5').DataTable({
				searching: false,
				paging:true,
				select: false,
				//info: false,         
				lengthChange:false 
				
			});
			$('#example tbody').on('click', 'tr', function () {
				var data = table.row( this ).data();
				
			});
		})(jQuery);
	</script>

          <!-- Required vendors {{ asset('templet/vendor/chart.js/Chart.bundle.min.js') }}-->
          <script src="{{ asset('templet/vendor/global/global.min.js') }}"></script>
          <script src="{{ asset('templet/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
          <script src="{{ asset('templet/vendor/chart.js/Chart.bundle.min.js') }}"></script>
          <script src="{{ asset('templet/js/custom.min.js')}}"></script>
          <script src="{{ asset('templet/js/deznav-init.js') }}"></script>
          <script src="{{ asset('templet/vendor/bootstrap-datetimepicker/js/moment.js')}}"></script>
          <script src="{{ asset('templet/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
          <!-- Chart piety plugin files -->
          <script src="{{ asset('templet/vendor/peity/jquery.peity.min.js')}}"></script>
          
          <!-- Apex Chart -->
          <script src="{{ asset('templet/vendor/apexchart/apexchart.js')}}"></script>
          <!-- Dashboard 1 -->
          <script src="{{ asset('templet/js/dashboard/doctor-details.js')}}"></script>
          <script>
              $(function () {
                  $('#datetimepicker1').datetimepicker({
                      inline: true,
                  });
              });
          </script>
</body>
</html>

