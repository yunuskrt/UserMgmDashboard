<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Project</title>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css"
      integrity="sha256-9mbkOfVho3ZPXfM7W8sV2SndrGDuh7wuyLjtsWeTI1Q="
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/users.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="js/sidebarhandler.js"></script>
  </head>
  <body>
    <!-- sidebar -->
    <?php include('components/sidebar.php'); ?>
    <!-- sidebar -->
    <!-- top nav -->
    <?php include('components/navbar.php'); ?>
    <!-- top nav -->
    
    <div id="usersvie" style="margin-top:50px;"> 
        <div class="ui container center aligned">
            <div class="ui centered card">
                <div class="content">
                    <div class="header">Integration with Third-Party Services</div>
                    <div class="meta">
                        <span class="category">Engineering</span>
                    </div>
                    <div class="description">
                        <p>Integrate the software with external APIs and services to enhance functionality and user experience.</p>
                    </div>
                </div>
                <div class="extra content">
                    <div class="left floated">
                        <span class="meta">Started 2022-11-0</span>
                    </div>
                    <div class="right floated">
                        <div class="ui yellow large label">Pending</div>
                    </div>
                </div>
            </div>   
            <div class="ui header">Must be completed until 2023-01-31</div>
            <div class="hidden divider"></div>
        </div>
        <div class="ui container">
            <button class="ui primary button right floated">
                <i class="plus icon"></i>
                Add Step
            </button>
            
            <div class="ui fluid vertical steps">
                <div class="completed step">
                    <i class="truck icon"></i>
                    <div class="content" style="flex: 1;">
                        <div class="title">Shipping</div>
                        <div class="description">Choose your shipping options</div>
                    </div>
                    <div>
                        <button class="ui button">
                            Edit
                        </button>
                        <button class="ui red button">
                            Remove
                        </button>
                    </div> 
                </div>
                <div class="completed step">
                    <i class="truck icon"></i>
                    <div class="content" style="flex: 1;">
                        <div class="title">Shipping</div>
                        <div class="description">Choose your shipping options</div>
                    </div>
                    <div>
                        <button class="ui button">
                            Edit
                        </button>
                        <button class="ui red button">
                            Remove
                        </button>
                    </div>     
                </div>
                <div class="completed step">
                    <i class="truck icon"></i>
                    <div class="content" style="flex: 1;">
                        <div class="title">Shipping</div>
                        <div class="description">Choose your shipping options</div>
                    </div>
                    <div>
                        <button class="ui button">
                            Edit
                        </button>
                        <button class="ui red button">
                            Remove
                        </button>
                    </div>   
                </div>
                <div class="active step">
                    <div class="content" style="flex: 1;">
                        <div class="title">Billing</div>
                        <div class="description">Enter billing information</div>
                    </div>
                    <div>
                        <button class="ui button">
                            Edit
                        </button>
                        <button class="ui red button">
                            Remove
                        </button>
                    </div> 
                </div>
            </div>
            <div class="hidden divider"></div>
        </div>
        
        <div class="ui container">
            <div class="ui green progress" id="projectprogress" style="margin-top:80px;">
                <div class="bar"></div>
            </div>
        </div>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"
      integrity="sha256-t8GepnyPmw9t+foMh3mKNvcorqNHamSKtKRxxpUEgFI="
      crossorigin="anonymous"
    ></script>
    
    <!-- DataTables cdn -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/1.4.1/js/dataTables.searchPanes.min.js"></script>
    <script src="https://cdn.datatables.net/pagination/1.3.3/js/dataTables.pagination.min.js"></script>
  </body>
<html>