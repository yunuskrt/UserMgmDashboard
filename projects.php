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
    <script src="assets/js/projects.js"></script>
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
    <div id="projectsview" style="margin-top:50px;">
      <div class="three column">
        <div class="ui container center aligned">
          <div class="column">   
            <h1 class="header center aligned">Projects</h1>
          </div>
        </div>
        <div class="ui container column">
          <div class="ui divider"></div>
        </div>
        <div class="column">
          <div class="ui link cards grid center aligned" id="projectcardscontainer">
            <!-- Project Cards displays here -->
          </div>
        </div>    
      </div>
    </div>

    <div id="projectview" style="margin-top:50px;"> 
        <div class="ui container center aligned">
            <div class="ui centered card">
                <div class="content">
                    <div class="header" id="projectcardheader"></div>
                    <div class="meta">
                        <span class="category" id="projectcarddepart"></span>
                    </div>
                    <div class="description">
                        <p id="projectcarddesc"></p>
                    </div>
                </div>
                <div class="extra content">
                    <div class="left floated">
                        <span class="meta" id="projectcardstartdatetext"></span>
                    </div>
                    <div class="right floated" id="projectcardstatus">
                    </div>
                </div>
            </div>   
            <div class="ui header" id="projectcardwarningtext"></div>
            <div class="hidden divider"></div>
        </div>
        <div class="ui container">
            <button class="ui primary button right floated" id="addstepbutton">
                <i class="plus icon"></i>
                    Add Step
            </button>
            
            <div class="ui fluid vertical steps" id="projectstepcontainer">  
            </div>
            <div class="hidden divider"></div>
        </div>
        
        <div class="ui container">
            <div class="ui green progress" id="projectprogress" style="margin-top:80px;">
                <div class="bar"></div>
                <div class="label" id="projectprogresslabel"></div>
            </div>
        </div>
    </div>
    <!-- Modals -->
    <!-- Add Step Modal -->
    <div class="ui tiny modal" id="addstepbuttonmodal">
        <i class="close icon"></i>
        <div class="header">
            Add Step
        </div>
        <div class="content">
            <div class="ui form">
                <div class="two fields">
                    <div class="field">
                        <label>Title</label>
                        <input type="text" placeholder="Title" id="addsteptitle">
                    </div>
                    <div class="field">
                        <label>Completed</label>
                        <select class="ui fluid search dropdown" id="addstepcompleted">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>                            
                        </select>
                    </div>   
                </div>
                <div class="ui divider"></div>
                <div class="field">
                    <label>Description</label>
                    <textarea id="addstepdescription" rows="4"></textarea>
                </div>
            </div>
        </div>
        <div class="actions">
            <div class="ui black deny button">
                Cancel
            </div>
            <div class="ui positive right labeled icon button" id="confirmaddstep">
                Confirm
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>
    <!-- Add Step Modal -->
    <!-- Edit Step Modal -->
    <div class="ui mini modal" id="editstepbuttonmodal">
        <i class="close icon"></i>
        <div class="header">
            Edit Step
        </div>
        <div class="content">
            <div class="ui form">
                <div class="field">
                    <label>Completed</label>
                    <select class="ui fluid search dropdown" id="editstepcompleted">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>                            
                    </select>
                </div>
            </div>
        </div>
        <div class="actions">
            <div class="ui black deny button">
                Cancel
            </div>
            <div class="ui positive right labeled icon button" id="confirmeditstep">
                Confirm
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>
    <!-- Edit Step Modal -->
    
    <!-- Remove Step modal -->
    <div class="ui basic modal" id="removestepmodal">
        <div class="ui icon header">
            <i class="trash alternate icon"></i>
            Delete step
        </div>
        <div class="content">
          Are you sure deleting the step?
        </div>
        <div class="actions">
            <div class="ui red basic cancel inverted button">
            <i class="remove icon"></i>
            No
            </div>
            <div class="ui green ok inverted button" id="confirmremovestep">
            <i class="checkmark icon"></i>
            Yes
            </div>
        </div>
    </div>
    <!-- Remove Step modal -->
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