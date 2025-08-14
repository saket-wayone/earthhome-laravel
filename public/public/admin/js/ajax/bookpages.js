

// Function to handle form submission
function getfiletype(value) {
    if(value ==1){
        $('#youtubefile').show();
        $('#audiofile').hide();

    }
    if(value ==2){
        $('#audiofile').show();
        $('#youtubefile').hide();
        $('#youtubefile').val('');

    }
   
}

$(document).ready(function() {
    const label = $(".click-to-upload");
    const fileInput = $("#fileInput");
    const dropzonePreview = $("#dropzone-preview");
    const progressContainer = $(".progress-container");
    const progressBar = $(".progress-bar");
    const message = $(".message");

    label.on("click", function() {
        fileInput.click();
    });

    fileInput.on("change", function() {
        const files = fileInput[0].files;
        const totalSize = calculateTotalSize(files);
        let invalidFileSize = false;

        // Check if total size exceeds 10MB
        if (totalSize > 10 * 1024 * 1024) {
            showMessage("Error: Total file size exceeds the limit of 10MB.");
            invalidFileSize = true;
        }

        // Check individual file sizes
        for (let i = 0; i < files.length; i++) {
            const fileSize = files[i].size;
            if (fileSize > 1024 * 1024) { // If file size exceeds 1MB
                showMessage("Error: File size exceeds the limit of 1MB.");
                invalidFileSize = true;
                break;
            }
        }

        if (invalidFileSize) {
            // Clear input field
            fileInput.val('');
            return;
        }

        // Proceed with other operations if file sizes are valid
        showMessage("Uploading files...");

        // Simulating upload process
        let progress = 0;
        const interval = setInterval(function() {
            progress += 10;
            if (progress <= 100) {
                updateProgress(progress);
            } else {
                clearInterval(interval);
                showMessage("Processing files, this may take a few minutes...");
                setTimeout(function() {
                    showMessage("Done");
                }, 3000); // Simulating processing time
            }
        }, 1000);

        // Clear previous images
        dropzonePreview.empty();
        var html = '';
        var count = $('#uploadedimageshere tr').length + 1;

        // Display selected images
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            const fileName = files[i].name.replace(/\.[^/.]+$/, ''); // Get the filename without extension
            reader.onload = function(e) {
                const img = $("<img>").attr("src", e.target.result).css("width", "100px");

                // Append count, image, and title input to the HTML string
                html += '<tr>';
                html += '<th scope="row">' + count + '</th>';
                html += '<td>' + img[0].outerHTML + '</td>'; // Append the outer HTML of the image element
                html += '<td><div class="mb-3"><input type="text" class="form-control" name="title[]" placeholder="Enter your Book Title" id="firstNameinput_' + count + '" value="' + fileName + '"><div class="error-message" id="name-error"></div></div></td>';
                html += '<td><div class="mb-3" id="youtubefile"><input type="text" class="form-control" name="youtube[]" placeholder="Paste Your Youtube URL" id="youtubeInput_' + count + '"></div></td>';
                html += '<td><div class="mb-3" id="audiofile" ><input type="file" accept=".mp3,audio/*" class="form-control" name="audio[]" placeholder="Enter company name" id="companyNameinput_' + count + '"><div class="error-message" id="company_name-error"></div></div></td>';
                html += '<td><button class="move-up-btn btn btn-sm btn-primary" data-row-index="' + count + '">↑</button>&nbsp;&nbsp;<button class="move-down-btn btn btn-sm btn-primary" data-row-index="' + count + '"> ↓</button></td>';
                html += '</tr>';
                count++;

                // If all images are loaded, update the HTML
                if (count > files.length) {
                    $('#uploadedimageshere').append(html);
                }
            };
            reader.readAsDataURL(files[i]);
        }
    });

    // Move row up
    $(document).on("click", ".move-up-btn", function(e) {
        e.preventDefault();
        const currentRow = $(this).closest("tr");
        const previousRow = currentRow.prev("tr");
        if (previousRow.length !== 0) {
            currentRow.insertBefore(previousRow);
            updateSequenceNumbers();
        }
    });

    // Move row down
    $(document).on("click", ".move-down-btn", function(e) {
        e.preventDefault();
        const currentRow = $(this).closest("tr");
        const nextRow = currentRow.next("tr");
        if (nextRow.length !== 0) {
            currentRow.insertAfter(nextRow);
            updateSequenceNumbers();
        }
    });

    function calculateTotalSize(files) {
        let totalSize = 0;
        for (let i = 0; i < files.length; i++) {
            totalSize += files[i].size;
        }
        return totalSize;
    }

    function updateProgress(progress) {
        progressContainer.show();
        progressBar.css("width", progress + "%");
    }

    function showMessage(msg) {
        $('.message').html(msg);
        // message.text(msg);
    }

    function updateSequenceNumbers() {
        $('#uploadedimageshere tr').each(function(index, row) {
            $(row).find('th').text(index + 1);
        });
    }

    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    // Handle submit button click
    $('#submitBtn').on('click', function(e) {
        e.preventDefault();
        // Collect data from each row and prepare it for submission
        const formData = new FormData();
        $('#uploadedimageshere tr').each(function(index, row) {
            const sequenceNumber = $(row).find('th').text(); // Get sequence number from the table row
            const fileName = $(row).find('input[name="title[]"]').val();
            const bookid = $('#book_id').val();
            const youtubeLink = $(row).find('input[name="youtube[]"]').val();
            const audioFile = $(row).find('input[name="audio[]"]')[0].files[0]; // Assuming only one audio file per row
    
            // Get image data
            const imgDataUrl = $(row).find('img').attr('src');
            const imgBlob = dataURLtoBlob(imgDataUrl);
            const imgFile = new File([imgBlob], fileName + '.png', {
                type: 'image/png'
            });
    
            formData.append('sequenceNumber[' + sequenceNumber + ']', sequenceNumber); // Append sequence number with the data
            formData.append('fileName[' + sequenceNumber + ']', fileName);
            formData.append('youtubeLink[' + sequenceNumber + ']', youtubeLink);
            formData.append('audioFile[' + sequenceNumber + ']', audioFile);
            formData.append('imageFile[' + sequenceNumber + ']', imgFile);
            formData.append('book_id', bookid);
        });
    
        // Send formData via AJAX to your Laravel controller
        $.ajax({
            url: window.origin + '/admin/books/uploadpages', // Change this to your Laravel route
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.message);
              window.location.href=window.location.href;
                
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
            }
        });
    });

    // Function to convert data URL to Blob
    function dataURLtoBlob(dataUrl) {
        const arr = dataUrl.split(',');
        const mime = arr[0].match(/:(.*?);/)[1];
        const bstr = atob(arr[1]);
        let n = bstr.length;
        const u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new Blob([u8arr], {
            type: mime
        });
    }

});




function confirmDelete1(id, type) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You want to '+type +' this record!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, '+type +' it!'
    }).then((result) => {
        if (result.isConfirmed) {
            let token = $('meta[name="csrf-token"]').attr('content');

            // If user confirms, send Ajax request to delete the record
            $.ajax({
                url: '/admin/books/deletepage/' + id, // Update the URL to your delete route
                type: 'POST',
                data: {
                    _token: token, // Include CSRF token in the request
                    type: type, // Include CSRF token in the request
                    id: id, // Include CSRF token in the request
                },
                success: function(response) {
                    // If delete is successful, show success message
                    Swal.fire(
                        type,
                        'Record has been ' + type+'.',
                        'success'
                    ).then(() => {
                        // Reload the page or update the table as per your requirement
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    // If there is an error, show error message
                    Swal.fire(
                        'Error!',
                        'An error occurred while deleting the record.',
                        'error'
                    );
                }
            });
        }
    });
}