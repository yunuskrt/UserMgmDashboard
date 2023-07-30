// converts queries into objects
function useQuery() {
	var queries = {}
	var key
	var params = window.location.href
		.slice(window.location.href.indexOf('?') + 1)
		.split('&')
	for (var i = 0; i < params.length; i++) {
		// iterating over queries
		key = params[i].split('=') // turn query into key,value pair
		queries[key[0]] = key[1]
	}
	return queries
}
function generateLabelGrid(labelsArray) {
	let htmlElement = ''
	let i
	let color

	for (i = 0; i < labelsArray.length; i++) {
		const labelId = labelsArray[i].id.toString()
		const deleteIcon =
			'<i class="delete icon closeskill" id="skilllabel-' + labelId + '"></i>'
		i % 5 === 0
			? (color = 'blue')
			: i % 4 === 0
			? (color = 'teal')
			: i % 3 === 0
			? (color = 'green')
			: i % 2 === 0
			? (color = 'orange')
			: (color = 'brown')
		if (i === 0) {
			htmlElement +=
				'<div class="row"><div class="ui ' +
				color +
				' label">' +
				labelsArray[i].title +
				deleteIcon +
				'</div>'
		} else if (i % 10 === 0) {
			// 10 label maximum in each row
			htmlElement +=
				'</div><div class="row"><div class="ui ' +
				color +
				' label">' +
				labelsArray[i].title +
				deleteIcon +
				'</div>'
		} else {
			htmlElement +=
				'<div class="ui ' +
				color +
				' label" >' +
				labelsArray[i].title +
				deleteIcon +
				'</div>'
		}
	}
	if (labelsArray.length !== 0) {
		htmlElement += '</div>'
	}
	return htmlElement
}

$(document).ready(async function () {
	const queries = useQuery()
	if (queries.hasOwnProperty('userId')) {
		// Hide users view
		$('#usersview').hide()
		// Get user with Ajax requext
		await $.get({
			url: './api/users.php?userId=' + queries.userId,
			contentType: 'application/json',
			success: function (data) {
				user = data
				$('#userItemPicture').attr('src', data.picture)
				$('#userItemName').text(data.name + ' - ' + data.age)
				$('#userItemDepartment').html(`
                    <div>${data.department}<button class="ui button" style="margin-left:15px;" id="addskillbutton">
                    Add skill
                    </button>
                    </div>
                  `)
				$('#labelGrid').html(generateLabelGrid(data.skills))
				console.log(data)

				const projects_involved = data.projects_involved
				const projects_of_depart = data.projects_of_depart
				const projects_not_involved = projects_of_depart - projects_involved
				if (projects_of_depart > 0) {
					const chartData = [
						{ name: 'Involved', y: projects_involved },
						{ name: 'Not Involved', y: projects_not_involved },
						// Add more data points as needed
					]

					// Create the chart
					Highcharts.chart('chartContainer', {
						chart: {
							type: 'pie', // Change the chart type as needed (e.g., line, bar, etc.)
							width: 300,
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
								name: '# of Projects',
								data: chartData,
							},
						],
					})

					// Create the table
					if (projects_involved > 0) {
						$('#userProjectTable').DataTable({
							responsive: true,
							data: data.projects,
							columns: [
								{
									data: null,
									title: 'Title',
									render: function (data) {
										return `<a href="/usermgmdash/projects.php?projectId=${data.id}" style="text-decoration: none; color:black;"id="projectInvolvedTitle">${data.title}</a>`
									},
								},
								{ data: 'startDate', title: 'Start Date' },
								{ data: 'endDate', title: 'End Date' },
								{
									data: null,
									title: 'Status',
									render: function (data) {
										const labelColor =
											data.statu === 'active'
												? 'blue'
												: data.statu === 'pending'
												? 'yellow'
												: 'green'
										const labelText =
											data.statu === 'active'
												? 'Active'
												: data.statu === 'pending'
												? 'Pending'
												: 'Completed'
										return `<div class="ui ${labelColor} label">${labelText} </div>`
									},
								},
								{
									// Custom column for buttons
									data: null,
									render: function () {
										// Create the remove and edit buttons
										return (
											'<div class="ui vertical animated inverted red button" tabindex="0" id="deleteProjectInvolved"><div class="hidden content">Remove</div><div class="visible content"><i class="minus icon"></i></div></div>' +
											'<div class="ui vertical animated inverted orange button edit" tabindex="0" id="editProjectInvolved"><div class="hidden content">Edit</div><div class="visible content"><i class="pencil alternate icon"></i></div></div>'
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
								info: '',
							},
							rowCallback: function (row, data) {
								$(row)
									.find('#deleteProjectInvolved')
									.on('click', function () {
										// Display and handle the remove modal
										$('#removeprojectinvolvedcontent').html(
											`<p>Are you sure deleting this project?</p><h3>${data.title}</h3>`
										)
										$('#removeprojectinvolvedbuttonmodal').modal('show')

										// Ajax DELETE request on click of confirmremove button
										$('#confirmremoveprojectinvolved').on('click', function () {
											console.log('Delete request of this project: ', data)
											$.ajax({
												url: `./api/projects.php?projectId=${data.id}`,
												type: 'delete',
												contentType: 'application/json',
												success: function () {
													alert('Project Deleted successfully!')
												},
											})
											location.reload()
										})
									})

								$(row)
									.find('#editProjectInvolved')
									.on('click', function () {
										// Display and handle the edit modal
										$('#editprojectinvolvedheader').text(`Edit - ${data.title}`)

										// Assign the initial values to inputs
										$('#editprojectinvolvedtitle').val(data.title)
										$('#editprojectinvolvedstatus').val(data.statu)
										$('#editprojectinvolvedstartdate').val(data.startDate)
										$('#editprojectinvolvedenddate').val(data.endDate)
										$('#editprojectinvolveddesc').val(data.description)

										$('#editprojectinvolvedbuttonmodal').modal('show')

										// Ajax PUT request onclick of confirmedit button
										$('#confirmeditprojectinvolved').on(
											'click',
											async function () {
												await $.ajax({
													url: './api/projects.php',
													data: JSON.stringify({
														id: data.id,
														title: $('#editprojectinvolvedtitle').val(),
														status: $('#editprojectinvolvedstatus').val(),
														endDate: $('#editprojectinvolvedenddate').val(),
														description: $('#editprojectinvolveddesc').val(),
													}),
													type: 'put',
													contentType: 'application/json',
													success: function () {
														location.reload()
														alert('Project Updated successfully!')
													},
												})
											}
										)
									})
							},
						})
					}
					$('#addskillbutton').on('click', function () {
						// Display and handle add skill modal
						$('#addskillbuttonmodal').modal('show')

						// AJAX Post request to skill
						$('#confirmaddskill').on('click', function () {
							$.post({
								url: './api/skills.php',
								data: JSON.stringify({
									title: $('#addskillfield').val(),
									userId: data.id,
								}),
								contentType: 'application/json',
								success: function () {
									alert('Skill Inserted successfully!')
								},
							})
							location.reload()
						})
					})
					$('.closeskill').on('click', function () {
						var iconId = $(this).attr('id')
						const id = iconId.split('-')[1]
						// id of skill extracted

						// Display and handle the Delete Skill Modal
						$('#removeskillmodal').modal('show')

						$('#confirmremoveskill').on('click', function () {
							// AJAX DELETE request to skill
							$.ajax({
								url: `./api/skills.php?skillId=${id}`,
								type: 'delete',
								contentType: 'application/json',
								success: function () {
									alert('Skill Deleted successfully!')
								},
							})
							location.reload()
						})
					})

					$('#userskillsstat').text(data.skills.length)
					$('#userinvolvedprojstat').text(projects_involved)
					$('#userenteredyearstat').text(data.enteredDate.split('-')[0])
				}
			},
		})
	} else {
		// Hide userview
		$('#userview').hide()
		$.get({
			url: './api/users.php',
			contentType: 'application/json',
			success: function (data) {
				let cardsHtml = ''
				data.map((user) => {
					cardsHtml += ` 
                    <div class="card userItem" id="userview-${user.id}">
                        <div class="image">
                            <img src="${user.picture}">
                        </div>
                        <div class="content">
                            <div class="header">${user.name}</div>
                            <div class="meta">
                                <a>${user.department}</a>
                            </div>
                        </div>
                        <div class="extra content">
                            <span>
                                <i class="envelope icon"></i>
                                    ${user.email}
                            </span>
                        </div>
                    </div>
                    `
				})
				$('#usercardscontainer').html(cardsHtml)
				$('.userItem').on('click', function () {
					const userId = $(this).attr('id')
					const id = userId.split('-')[1]
					// id of user extracted
					// navigate to corresponding user detail page
					window.location.href = `/usermgmdash/users.php?userId=${id}`
				})
			},
		})
	}
})
