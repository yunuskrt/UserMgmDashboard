$(document).ready(function () {
	// $('.ui.dropdown').dropdown()
	$('.sidebar-menu-toggler').on('click', function () {
		var target = $(this).data('target')
		$(target)
			.sidebar({
				dinPage: true,
				transition: 'overlay',
				mobileTransition: 'overlay',
			})
			.sidebar('toggle')
	})

	// Fetch JSON data from example.php using Ajax
	$.get({
		url: './api/users.php',
		dataType: 'json',
		success: function (data) {
			$('#userTable').DataTable({
				responsive: true,
				data: data,
				columns: [
					{
						// Custom column for buttons
						data: null,
						render: function (data) {
							// Create the remove and edit buttons
							return (
								'<h5 class="ui image header">' +
								'<img src="' +
								data.picture +
								'" class="ui mini rounded image">' +
								'<div class="content" id="userItemTable">' +
								data.name +
								'<div class="sub header">' +
								data.department +
								'</div></div></h5>'
							)
						},
						title: 'Employee',
					},
					{ data: 'email', title: 'Email' },
					{ data: 'role', title: 'Role' },
					{ data: 'age', title: 'Age' },
					{ data: 'enteredDate', title: 'Entered Date' },
					{
						// Custom column for buttons
						data: null,
						render: function () {
							// Create the remove and edit buttons
							return (
								'<div class="ui vertical animated inverted red button remove" tabindex="0"><div class="hidden content">Remove</div><div class="visible content"><i class="minus icon"></i></div></div>' +
								'<div class="ui vertical animated inverted orange button edit" tabindex="0"><div class="hidden content">Edit</div><div class="visible content"><i class="pencil alternate icon"></i></div></div>'
							)
						},
					},
				],
				columnDefs: [
					// Add styling to columns
					{ className: 'right aligned', targets: -1 },
					{ targets: -1, width: '10rem' },
					{ orderable: false, targets: -1 },
				],

				// Add styling to datatable
				language: {
					search: '',
					searchPlaceholder: 'Search...',
					processing: 'Processing...',
					zeroRecords: 'No matching records found',
					lengthMenu: 'Show _MENU_ entries',
					info: '<button class="ui primary active button" id="adduserbutton"><i class="add user icon"></i>Add User</button>',
				},
				rowCallback: function (row, data) {
					$(row)
						.find('#userItemTable')
						.on('click', function () {
							// Navigate to user details page
							window.location.href = '/usermgmdash/users.php?userId=' + data.id
						})
					$(row)
						.find('.remove')
						.on('click', function () {
							// Display and handle the remove modal
							$('#removecontent').html(
								'<p>Are you sure deleting this user?</p><h3>' +
									data.name +
									'</h3>'
							)
							$('#removebuttonmodal').modal('show')

							// Ajax DELETE request on click of confirmremove button
							$('#confirmremoveuser').on('click', function () {
								$.ajax({
									url: './api/users.php',
									data: JSON.stringify({
										id: data.id,
									}),
									type: 'delete',
									contentType: 'application/json',
									success: function () {
										alert('User Deleted successfully!')
									},
								})

								location.reload()
							})
						})

					$(row)
						.find('.edit')
						.on('click', function () {
							// Display and handle the edit modal

							$('#editcontent').html(
								'<div class="ui small image"><img src="' +
									data.picture +
									'"></div>'
							)
							// Assign the initial values to inputs
							$('#editname').val(data.name)
							$('#editgender').val(data.gender)
							$('#editage').val(data.age)
							$('#editusername').val(data.username)
							$('#editemail').val(data.email)
							$('#editrole').val(data.role)
							$('#editpicture').val(data.picture)

							$('#editbuttonmodal').modal('show')

							// Ajax PUT request onclick of confirmedit button
							$('#confirmedituser').on('click', function () {
								$.ajax({
									url: './api/users.php',
									data: JSON.stringify({
										id: data.id,
										username: $('#editusername').val(),
										email: $('#editemail').val(),
										role: $('#editrole').val(),
										picture: $('#editpicture').val(),
									}),
									type: 'put',
									contentType: 'application/json',
									success: function () {
										console.log({
											id: data.id,
											username: $('#editusername').val(),
											email: $('#editemail').val(),
											role: $('#editrole').val(),
											picture: $('#editpicture').val(),
										})
										alert('User Updated successfully!')
									},
								})
								location.reload()
							})
						})
				},
			})
			$('#adduserbutton').on('click', function () {
				// Display and handle the create modal
				$('#adduserbuttonmodal').modal('show')
				// Ajax POST request onclick of confirmcreate button
				var currentDate = new Date()
				var dateString =
					currentDate.getFullYear() +
					'-' +
					('0' + (currentDate.getMonth() + 1)).slice(-2) +
					'-' +
					('0' + currentDate.getDate()).slice(-2)

				$('#confirmcreateuser').on('click', function () {
					$.post({
						url: './api/users.php',
						data: JSON.stringify({
							name:
								$('#createfirstname').val() + ' ' + $('#createlastname').val(),
							username: $('#createusername').val(),
							gender: $('#creategender').val(),
							age: $('#createage').val(),
							email: $('#createemail').val(),
							parole: $('#createpassword').val(),
							role: $('#createrole').val(),
							department: $('#createdepartment').val(),
							picture: $('#createpicture').val(),
							enteredDate: dateString,
						}),
						contentType: 'application/json',
						success: function () {
							alert('User Inserted successfully!')
						},
					})
					location.reload()
				})
			})
			// $('.ui.dropdown').dropdown()
			$('.sidebar-menu-toggler').on('click', function () {
				var target = $(this).data('target')
				$(target)
					.sidebar({
						dinPage: true,
						transition: 'overlay',
						mobileTransition: 'overlay',
					})
					.sidebar('toggle')
			})
		},
		error: function (error) {
			console.error('Error fetching JSON data:', error)
		},
	})
})
