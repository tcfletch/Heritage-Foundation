<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Gallery</title>
    <style>
        #pdfContainer {
            width: 600px; 
            height: 600px; 
            border: 1px solid #ccc;
            overflow: hidden; 
            margin: auto; 
            position: relative; 
        }

        #pdfFrame {
            width: 100%;
            height: 100%;
            border: none; 
        }

        .navButton {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            cursor: pointer;
        }

        #prevBtn {
            left: 10px;
        }

        #nextBtn {
            right: 10px;
        }
    </style>
</head>
<body>
    <h1>PDF Gallery</h1>

    <div id="pdfContainer">
        <iframe id="pdfFrame" src="" frameborder="0"></iframe>
        <button id="prevBtn" class="navButton" onclick="prevPDF()">Previous</button>
        <button id="nextBtn" class="navButton" onclick="nextPDF()">Next</button>
    </div>

    <script>
        const pdfPaths = <?php
$id = '13-0-2-469';
$pdfFiles = glob("formsAndPictures/{$id}*.pdf");
echo json_encode($pdfFiles);
?>


        let currentIndex = 0;

        function showPDF(index) {
            const pdfFrame = document.getElementById('pdfFrame');
            pdfFrame.src = pdfPaths[index];
            currentIndex = index;
        }

        function prevPDF() {
            if (currentIndex > 0) {
                showPDF(currentIndex - 1);
            }
        }

        function nextPDF() {
            if (currentIndex < pdfPaths.length - 1) {
                showPDF(currentIndex + 1);
            }
        }

        if (pdfPaths.length > 0) {
            showPDF(0);
        } else {
            alert('No PDF files found.');
        }
    </script>
</body>
</html>