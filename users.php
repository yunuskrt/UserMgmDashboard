<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>User</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha256-9mbkOfVho3ZPXfM7W8sV2SndrGDuh7wuyLjtsWeTI1Q=" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/users.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
</head>

<body>
  <!-- top nav -->
  <?php include('components/navbar.php'); ?>
  <!-- top nav -->
  <div id="userview">
    <div class="ui container" style="margin-top:50px;">
      <div class="ui grid center aligned">
        <div class="three column row">
          <div class="column">
            <img class="ui circular centered medium image" id="userItemPicture">
            <h2 class="ui header" id="userItemName"></h2>
            <p class="meta-text" id="userItemDepartment"></p>
          </div>
        </div>
        <div class="ui grid center aligned" id="labelGrid">
          <!-- Skill labels -->
        </div>
        <div class="ui hidden divider"></div>
      </div>
      <h2 class="ui header">Projects Involved</h2>
      <div class="ui divider"></div>
      <div class="ui grid center aligned">
        <div class="five column row">
          <div class="five wide computer ten wide tablet twenty wide mobile center aligned column">
            <!-- HighChart -->
            <div id="chartContainer"></div>
          </div>
          <div class="ten wide center aligned column">
            <table id="userProjectTable" class="ui selectable table">
              <tbody>
                <!-- Projects Involved data table -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="ui grid stackable padded center aligned">
        <div class="four wide computer eight wide tablet sixteen wide mobile  center aligned column">
          <div class="ui teal statistic">
            <div class="value" id="userskillsstat">
            </div>
            <div class="label">
              Skills
            </div>
          </div>
        </div>
        <div class="four wide computer eight wide tablet sixteen wide mobile  center aligned column">
          <div class="ui purple statistic">
            <div class="value" id="userinvolvedprojstat">
            </div>
            <div class="label">
              Involved Projects
            </div>
          </div>
        </div>
        <div class="four wide computer eight wide tablet sixteen wide mobile  center aligned column">
          <div class="ui green statistic">
            <div class="value" id="userenteredyearstat">
            </div>
            <div class="label">
              Entered Year
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="usersview" style="margin-top:50px;">
    <div class="three column">
      <div class="ui container center aligned">
        <div class="column">
          <h1 class="header center aligned">Users</h1>
        </div>
      </div>
      <div class="ui container column">
        <div class="ui divider"></div>
      </div>
      <div class="column">
        <div class="ui link cards grid center aligned" id="usercardscontainer">
          <!-- User Cards displays here -->
        </div>
      </div>
    </div>
  </div>



  <!-- Modals -->
  <!-- Remove Project button modal -->
  <div class="ui basic modal" id="removeprojectinvolvedbuttonmodal">
    <div class="ui icon header">
      <i class="trash alternate icon"></i>
      Delete Project
    </div>
    <div class="content" id="removeprojectinvolvedcontent">
    </div>
    <div class="actions">
      <div class="ui red basic cancel inverted button">
        <i class="remove icon"></i>
        No
      </div>
      <div class="ui green ok inverted button" id="confirmremoveprojectinvolved">
        <i class="checkmark icon"></i>
        Yes
      </div>
    </div>
  </div>
  <!-- Remove Project button modal -->
  <!-- Edit Project Button Modal -->
  <div class="ui tiny modal" id="editprojectinvolvedbuttonmodal">
    <div class="header" id="editprojectinvolvedheader">Header</div>
    <div class="content">
      <div class="ui form">
        <div class="two fields">
          <div class="field">
            <label>Project Title</label>
            <input type="text" placeholder="Project Title" id="editprojectinvolvedtitle">
          </div>
          <div class="field">
            <label>Status</label>
            <select class="ui fluid search dropdown" id="editprojectinvolvedstatus">
              <option value="active">Active</option>
              <option value="pending">Pending</option>
              <option value="finished">Completed</option>
            </select>
          </div>
        </div>
        <div class="ui divider"></div>
        <div class="two fields">
          <div class="field">
            <label>Start Date</label>
            <input type="date" id="editprojectinvolvedstartdate" disabled>
          </div>
          <div class="field">
            <label>End Date</label>
            <input type="date" id="editprojectinvolvedenddate">
          </div>
        </div>
        <div class="ui divider"></div>
        <div class="field">
          <label>Description</label>
          <textarea id="editprojectinvolveddesc" rows="4"></textarea>
        </div>
      </div>
    </div>
    <div class="actions">
      <div class="ui black deny button">
        Cancel
      </div>
      <div class="ui positive right labeled icon button" id="confirmeditprojectinvolved">
        Confirm
        <i class="checkmark icon"></i>
      </div>
    </div>
  </div>
  <!-- Edit Project Button Modal -->
  <!-- Add Skill Modal -->
  <div class="ui mini modal" id="addskillbuttonmodal">
    <i class="close icon"></i>
    <div class="header">
      Add Skill
    </div>
    <div class="content">
      <div class="ui form">
        <div class="field">
          <label>Skill</label>
          <input type="text" placeholder="Add Skill" id="addskillfield">
        </div>
      </div>
    </div>
    <div class="actions">
      <div class="ui black deny button">
        Cancel
      </div>
      <div class="ui positive right labeled icon button" id="confirmaddskill">
        Confirm
        <i class="checkmark icon"></i>
      </div>
    </div>
  </div>
  <!-- Add Skill Modal -->
  <!-- Remove Skill modal -->
  <div class="ui basic modal" id="removeskillmodal">
    <div class="ui icon header">
      <i class="trash alternate icon"></i>
      Delete skill
    </div>
    <div class="content">
      Are you sure deleting the skill?
    </div>
    <div class="actions">
      <div class="ui red basic cancel inverted button">
        <i class="remove icon"></i>
        No
      </div>
      <div class="ui green ok inverted button" id="confirmremoveskill">
        <i class="checkmark icon"></i>
        Yes
      </div>
    </div>
  </div>
  <!-- Remove Skill modal -->

  <!-- Semantic ui cdn -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" integrity="sha256-t8GepnyPmw9t+foMh3mKNvcorqNHamSKtKRxxpUEgFI=" crossorigin="anonymous"></script>

  <!-- DataTables cdn -->
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

</body>
<html>