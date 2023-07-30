$(document).ready(function () {
	// Fetch JSON data using Ajax
	$.get({
		url: './api/users.php',
		dataType: 'json',
		success: function (data) {
			function prepareData() {
				// column chart
				var maleCount = 0
				var femaleCount = 0
				// column chart

				// bar chart
				var departmentCount = {}
				// bar chart

				// pie chart
				var adminCount = 0
				var superadminCount = 0
				var employeeCount = 0
				// pie chart

				//pie chart 2
				var twenties = 0
				var thirties = 0
				var fourties = 0
				var fiftyplus = 0
				// pie chart 2

				data.map((item) => {
					// column
					if (item.gender === 'Male') {
						maleCount++
					} else {
						femaleCount++
					}
					// bar
					let department = item.department
					if (departmentCount.hasOwnProperty(department)) {
						departmentCount[department]++
					} else {
						departmentCount[department] = 1
					}
					// pie
					if (item.role === 'Admin') {
						adminCount++
					} else if (item.role === 'Superadmin') {
						superadminCount++
					} else {
						employeeCount++
					}
					// pie 2
					if (item.age >= 20 && item.age < 30) {
						twenties++
					} else if (item.age >= 30 && item.age < 40) {
						thirties++
					} else if (item.age >= 40 && item.age < 50) {
						fourties++
					} else {
						fiftyplus++
					}
				})

				return {
					column: [maleCount, femaleCount],
					bar: [Object.keys(departmentCount), Object.values(departmentCount)],
					pie: [
						{ name: 'Admin', y: adminCount },
						{ name: 'Superadmin', y: superadminCount },
						{ name: 'Employee', y: employeeCount },
					],
					pie2: [
						{ name: '20-29', y: twenties },
						{ name: '30-39', y: thirties },
						{ name: '40-49', y: fourties },
						{ name: '50+', y: fiftyplus },
					],
				}
			}

			const chartsData = prepareData()
			Highcharts.chart('pierole', {
				chart: {
					type: 'pie',
					width: 300,
				},
				accessibility: {
					enabled: false,
				},
				title: { text: null },
				plotOptions: {
					pie: {
						dataLabels: {
							enabled: false,
						},
					},
				},
				series: [
					{
						name: 'Roles',
						colorByPoint: true,
						data: chartsData.pie,
					},
				],
			})
			Highcharts.chart('bardepartment', {
				chart: {
					type: 'bar',
				},
				accessibility: {
					enabled: false,
				},
				title: {
					text: null,
				},
				xAxis: {
					categories: chartsData.bar[0],
					title: {
						text: 'Department',
					},
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Number of Employees',
					},
				},
				series: [
					{
						name: 'Employees',
						data: chartsData.bar[1],
					},
				],
			})
			Highcharts.chart('columngender', {
				chart: {
					type: 'column',
					width: 300,
				},
				accessibility: {
					enabled: false,
				},
				title: { text: null },
				xAxis: {
					categories: ['Male', 'Female'],
					title: {
						text: 'Gender',
					},
				},
				yAxis: {
					min: 0,
					title: {
						text: 'Number of Employees',
					},
				},
				series: [
					{
						name: 'Employees',
						data: chartsData.column,
					},
				],
			})

			Highcharts.chart('pieage', {
				chart: {
					type: 'pie',
					width: 300,
				},
				accessibility: {
					enabled: false,
				},
				title: { text: null },
				plotOptions: {
					pie: {
						dataLabels: {
							enabled: false,
						},
					},
				},

				series: [
					{
						name: 'Age',
						colorByPoint: true,
						data: chartsData.pie2,
					},
				],
			})

			$('#userTable').DataTable({
				responsive: true,
				data: data,
				columns: [
					{
						data: null,
						render: function (data) {
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
		},
		error: function (error) {
			console.error('Error fetching JSON data:', error)
		},
	})
})
