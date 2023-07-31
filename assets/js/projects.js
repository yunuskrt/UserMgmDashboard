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

$(document).ready(async function () {
	// Get query
	const queries = useQuery()
	if (queries.hasOwnProperty('projectId')) {
		// Hide projects view
		$('#projectsview').hide()
		// Fetch data
		await $.get({
			url: './api/projects.php?projectId=' + queries.projectId,
			contentType: 'application/json',
			success: function (data) {
				// Assign the values of data to front-end
				$('#projectcarddepart').text(data.department)
				$('#projectcardheader').text(data.title)
				$('#projectcarddesc').text(data.description)
				$('#projectcardstartdatetext').text(`Started ${data.startDate}`)
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
				$('#projectcardstatus').html(
					`<div class="ui ${labelColor} large label">${labelText} </div>`
				)
				$('#projectcardwarningtext').text(
					`Must be completed until ${data.endDate}`
				)

				// set the steps
				var completedStepCount = 0
				var stepsContainerHtml = ''

				data.steps.map((step) => {
					let stepHtml =
						step.completed === 'Yes'
							? `<div class="completed step">
			        <i class="truck icon"></i>
			        <div class="content" style="flex: 1;">
			            <div class="title">${step.title}</div>
			            <div class="description">${step.description}</div>
			        </div>
                        <button class="ui button editStep" id="stepitemedit-${step.id}-${step.completed}">
							Edit
						</button>
						<button class="ui red button deleteStep" id="stepitemremove-${step.id}">
							Remove
						</button>
			    </div>`
							: `<div class="active step">
			        <div class="content" style="flex: 1;">
			            <div class="title">${step.title}</div>
			            <div class="description">${step.description}</div>
			        </div>
                        <button class="ui button editStep" id="stepitemedit-${step.id}-${step.completed}">
							Edit
						</button>
						<button class="ui red button deleteStep" id="stepitemremove-${step.id}">
							Remove
						</button>
			    </div>`
					stepsContainerHtml += stepHtml
					if (step.completed === 'Yes') {
						completedStepCount++
					}
				})
				$('#projectstepcontainer').html(stepsContainerHtml)

				// set the progress bar
				const percent = Math.round(
					(completedStepCount / data.steps.length) * 100
				)
				$('#projectprogress').progress({
					percent: percent,
				})
				$('#projectprogresslabel').text(
					`${percent}% of project steps completed`
				)

				// handle add step
				$('#addstepbutton').on('click', function () {
					$('#addstepbuttonmodal').modal('show')

					$('#confirmaddstep').on('click', async function () {
						await $.post({
							url: './api/steps.php',
							data: JSON.stringify({
								title: $('#addsteptitle').val(),
								description: $('#addstepdescription').val(),
								completed: $('#addstepcompleted').val(),
								projectId: data.id,
							}),
							contentType: 'application/json',
							success: function () {
								alert('Step Inserted successfully!')
							},
						})
						location.reload()
					})
				})

				// handle delete step
				$('.deleteStep').on('click', function () {
					const projectId = $(this).attr('id')
					const id = parseInt(projectId.split('-')[1])

					$('#removestepmodal').modal('show')

					$('#confirmremovestep').on('click', async function () {
						await $.ajax({
							url: `./api/steps.php?stepId=${id}`,
							type: 'delete',
							contentType: 'application/json',
							success: function () {
								alert('Step Deleted successfully!')
							},
						})
						location.reload()
					})
				})

				// handle edit step
				$('.editStep').on('click', function () {
					const itemId = $(this).attr('id')
					const items = itemId.split('-')
					const id = parseInt(items[1])
					const completed = items[2]

					$('#editstepcompleted').val(completed)
					$('#editstepbuttonmodal').modal('show')

					$('#confirmeditstep').on('click', async function () {
						await $.ajax({
							url: './api/steps.php',
							data: JSON.stringify({
								completed: $('#editstepcompleted').val(),
								stepId: id,
							}),
							type: 'put',
							contentType: 'application/json',
							success: function () {
								alert('Step Updated successfully!')
							},
						})
						location.reload()
					})
				})
			},
		})
	} else {
		// Hide project view
		$('#projectview').hide()
		$.get({
			url: './api/projects.php',
			contentType: 'application/json',
			success: function (data) {
				let cardsHtml = ''
				data.map((project) => {
					const labelColor =
						project.statu === 'active'
							? 'blue'
							: project.statu === 'pending'
							? 'yellow'
							: 'green'
					const labelText =
						project.statu === 'active'
							? 'Active'
							: project.statu === 'pending'
							? 'Pending'
							: 'Completed'

					cardsHtml += `<div class="card projectItem" id="projectitem-${project.id}">
                <div class="content">
                    <div class="header">${project.title}</div>
                    <div class="meta">
                        <span class="category">${project.department}</span>
                    </div>
                    <div class="description">
                        <p>${project.description}</p>
                    </div>
                </div>
                <div class="extra content">
                    <div class="left floated">
                        <span class="meta">Started ${project.startDate}</span>
                    </div>
                    <div class="right floated">
                        <div class="ui ${labelColor} large label">${labelText} </div>
                    </div>
                </div>
            </div>   `
				})
				$('#projectcardscontainer').html(cardsHtml)
				$('.projectItem').on('click', function () {
					const projectId = $(this).attr('id')
					const id = projectId.split('-')[1]
					// id of user extracted
					// navigate to corresponding user detail page
					window.location.href = `/usermgmdash/projects.php?projectId=${id}`
				})
			},
		})
	}
})
