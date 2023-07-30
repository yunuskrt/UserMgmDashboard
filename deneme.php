<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>FrontendFunn - Semantic UI - Sample Admin Dashboard Template</title>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css"
      integrity="sha256-9mbkOfVho3ZPXfM7W8sV2SndrGDuh7wuyLjtsWeTI1Q="
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/deneme.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/deneme.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    
  </head>

  <body>
    <!-- sidebar -->
    <?php include('components/sidebar.php'); ?>
    <!-- sidebar -->
    <!-- top nav -->
    <?php include('components/navbar.php'); ?>
    <!-- top nav -->

    <div class="pusher">
      <div class="main-content" style="margin-top:50px;">
        <div class="ui grid stackable padded">
          <div
            class="four wide computer eight wide tablet sixteen wide mobile column"
          >
            <div class="ui fluid card">
              <div class="content">
                <div class="ui right floated header red">
                  <i class="icon shopping cart"></i>
                </div>
                <div class="header">
                  <div class="ui red header">
                    3958
                  </div>
                </div>
                <div class="meta">
                  orders
                </div>
                <div class="description">
                  Elliot requested permission to view your contact details
                </div>
              </div>
              <div class="extra content">
                <div class="ui two buttons">
                  <div class="ui red button">More Info</div>
                </div>
              </div>
            </div>
          </div>
          <div
            class="four wide computer eight wide tablet sixteen wide mobile column"
          >
            <div class="ui fluid card">
              <div class="content">
                <div class="ui right floated header green">
                  <i class="icon clock"></i>
                </div>
                <div class="header">
                  <div class="ui header green">57.6%</div>
                </div>
                <div class="meta">
                  Time
                </div>
                <div class="description">
                  Elliot requested permission to view your contact details
                </div>
              </div>
              <div class="extra content">
                <div class="ui two buttons">
                  <div class="ui green button">More Info</div>
                </div>
              </div>
            </div>
          </div>
          <div
            class="four wide computer eight wide tablet sixteen wide mobile column"
          >
            <div class="ui fluid card">
              <div class="content">
                <div class="ui right floated header teal">
                  <i class="icon briefcase"></i>
                </div>
                <div class="header">
                  <div class="ui teal header">3112</div>
                </div>
                <div class="meta">
                  Saves
                </div>
                <div class="description">
                  Elliot requested permission to view your contact details
                </div>
              </div>
              <div class="extra content">
                <div class="ui two buttons">
                  <div class="ui teal button">More Info</div>
                </div>
              </div>
            </div>
          </div>
          <div
            class="four wide computer eight wide tablet sixteen wide mobile column"
          >
            <div class="ui fluid card">
              <div class="content">
                <div class="ui right floated header purple">
                  <i class="icon trophy"></i>
                </div>
                <div class="header">
                  <div class="ui purple header">9805</div>
                </div>
                <div class="meta">
                  Views
                </div>
                <div class="description">
                  Elliot requested permission to view your contact details
                </div>
              </div>
              <div class="extra content">
                <div class="ui two buttons">
                  <div class="ui purple button">More Info</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="ui grid stackable padded">
          <div class="column">
            <table id="denemeTable" class="ui selectable table">
                <tbody>
                <!-- Employee data will be loaded here -->
                </tbody>
            </table>

            <!-- Remove button modal -->
            <div class="ui basic modal" id="removebuttonmodal">
                <div class="ui icon header">
                    <i class="trash alternate icon"></i>
                    Delete User
                </div>
                <div class="content" id="removecontent">
                    <p>Are you sure deleting this user?</p>
                </div>
                <div class="actions">
                    <div class="ui red basic cancel inverted button">
                    <i class="remove icon"></i>
                    No
                    </div>
                    <div class="ui green ok inverted button" id="confirmremoveuser">
                    <i class="checkmark icon"></i>
                    Yes
                    </div>
                </div>
            </div>
            <!-- Remove button modal -->
            <!-- Edit Button Modal -->
            <div class="ui modal" id="editbuttonmodal">
                <i class="close icon"></i>
                <div class="header">
                    Edit User
                </div>
                <div class="image content">
                    <div id="editcontent"></div>
                    <div class="ui form">
                        <div class="three fields">
                            <div class="field">
                                <label>Name</label>
                                <input type="text" id="editname" disabled>
                            </div>
                            <div class="field">
                                <label>Gender</label>
                                <input type="text" id="editgender" disabled>
                            </div>
                            <div class="Age">
                                <label>Age</label>
                                <input type="text" id="editage" disabled>
                            </div>
                        </div>
                        <div class="ui divider"></div>
                        <div class="three fields">
                            <div class="field">
                                <label>Username</label>
                                <input type="text" placeholder="Username" id="editusername">
                            </div>
                            <div class="field">
                                <label>Email</label>
                                <input type="email" placeholder="Email" id="editemail">
                            </div>
                            <div class="field">
                                <label>Role</label>
                                <select class="ui fluid search dropdown" id="editrole">
                                    <option value="Admin">Admin</option>
                                    <option value="Superadmin">Superadmin</option>
                                    <option value="Employee">Employee</option>
                                </select>
                            </div>
                        </div>
                        <div class="ui divider"></div>
                        <div class="field">
                            <label>Picture</label>
                            <input type="text" placeholder="Picture Url" id="editpicture">
                        </div>
                        
                    </div>
                </div>
                <div class="actions">
                    <div class="ui black deny button">
                    Cancel
                    </div>
                    <div class="ui positive right labeled icon button" id="confirmedituser">
                    Confirm
                    <i class="checkmark icon"></i>
                    </div>
                </div>
            </div>
            <!-- Edit Button Modal -->
            <!-- Add User Modal -->
            <div class="ui modal" id="adduserbuttonmodal">
                <i class="close icon"></i>
                <div class="header">
                   Add User
                </div>
                <div class="content">
                    <div class="ui form">
                        <div class="field">
                            <label>Name</label>
                            <div class="two fields">
                                <div class="field">
                                    <input type="text" placeholder="First Name" id="createfirstname">
                                </div>
                                <div class="field">
                                    <input type="text" placeholder="Last Name" id="createlastname">
                                </div>
                            </div>
                        </div>

                        <div class="three fields">
                            <div class="field">
                                <label>Username</label>
                                <input type="text" placeholder="Username" id="createusername">
                            </div>
                             <div class="field">
                                <label>Gender</label>
                                <select class="ui fluid search dropdown" id="creategender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>Age</label>
                                <input type="number" placeholder="Age" id="createage">
                            </div>  
                        </div>

                        <div class="two fields">
                           <div class="field">
                                <label>Email</label>
                                <input type="email" placeholder="Email" id="createemail">
                            </div>
                            <div class="field">
                                <label>Password</label>
                                <input type="password" placeholder="Password" id="createpassword">
                            </div>
                        </div>

                        <div class="two fields">
                           <div class="field">
                                <label>Role</label>
                                <select class="ui fluid search dropdown" id="createrole">
                                    <option value="Admin">Admin</option>
                                    <option value="Superadmin">Superadmin</option>
                                    <option value="Employee">Employee</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>Department</label>
                                <select id="createdepartment">
                                    <option value="Customer Support">Customer Support</option>
                                    <option value="Engineering">Engineering</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Hr">Hr</option>
                                    <option value="It">It</option>
                                    <option value="Logistics">Logistics</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Operations">Operations</option>
                                    <option value="Research">Research</option>
                                    <option value="Sales">Sales</option>
                                </select>
                            </div>
                        </div>

                        <div class="field">
                            <label>Photo Url</label>
                            <input type="text" placeholder="Url for the user photo" id="createpicture">
                        </div>
                    </div>
                </div>
                <div class="actions">
                    <div class="ui black deny button">
                        Cancel
                    </div>
                    <div class="ui positive right labeled icon button" id="confirmcreateuser">
                        Confirm
                    <i class="checkmark icon"></i>
                    </div>
                </div>
            </div>
            <!-- Add User Modal -->
          </div>
        </div>
        <div class="ui grid stackable padded">
          <div
            class="four wide computer eight wide tablet sixteen wide mobile  center aligned column"
          >
            <div class="ui teal statistic">
              <div class="value">
                5,550
              </div>
              <div class="label">
                Downloads
              </div>
            </div>
          </div>
          <div
            class="four wide computer eight wide tablet sixteen wide mobile  center aligned column"
          >
            <div class="ui purple statistic">
              <div class="value">
                50+
              </div>
              <div class="label">
                Developers
              </div>
            </div>
          </div>
          <div
            class="four wide computer eight wide tablet sixteen wide mobile  center aligned column"
          >
            <div class="ui green statistic">
              <div class="value">
                800+
              </div>
              <div class="label">
                Commits
              </div>
            </div>
          </div>
          <div
            class="four wide computer eight wide tablet sixteen wide mobile center aligned column"
          >
            <div class="ui purple statistic">
              <div class="value">
                1000+
              </div>
              <div class="label">
                Cups of Coffee
              </div>
            </div>
          </div>
        </div>
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
</html>