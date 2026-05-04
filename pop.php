<!DOCTYPE html>
<html>
<head>
    <title>Cadet Data Storage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: lightblue;
        }
        input, button {
            font-size: 18px;
            font-weight: bold;
            margin: 5px;
            padding: 8px;
        }
        table {
            border-collapse: collapse;
            margin-top: 20px;
            width: 100%;
        }
        table, th, td {
            font-size: 18px;
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #333;
            color: white;
        }
    </style>
</head>
<body>

<h2>Cadet Data Form</h2>

<input type="text" id="name" placeholder="Cadet Name">
<input type="time" id="time">
<input type="number" id="mark" placeholder="Mark">
<input type="text" id="rank" placeholder="Rank (manual)">
<button onclick="addCadet()">Add Cadet</button>

<table id="cadetTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Time</th>
            <th>Mark</th>
            <th>Rank</th>
            <th>Grade</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<script>
let editIndex = -1;

window.onload = displayCadets;

function getCadets() {
    return JSON.parse(localStorage.getItem("cadets")) || [];
}

function saveCadets(cadets) {
    localStorage.setItem("cadets", JSON.stringify(cadets));
}

function addCadet() {
    let name = document.getElementById("name").value.trim();
    let time = document.getElementById("time").value;
    let mark = document.getElementById("mark").value.trim();
    let rank = document.getElementById("rank").value.trim();

    if (!name || !time || !mark || !rank) {
        alert("Please fill all fields!");
        return;
    }

    let cadets = getCadets();

    if (editIndex === -1) {
        cadets.push({ name, time, mark: parseInt(mark), rank });
    } else {
        cadets[editIndex] = { name, time, mark: parseInt(mark), rank };
        editIndex = -1;
    }

    saveCadets(cadets);
    clearForm();
    displayCadets();
}

function editCadet(index) {
    let cadets = getCadets();
    let cadet = cadets[index];

    document.getElementById("name").value = cadet.name;
    document.getElementById("time").value = cadet.time;
    document.getElementById("mark").value = cadet.mark;
    document.getElementById("rank").value = cadet.rank;

    editIndex = index;
}

function deleteCadet(index) {
    let cadets = getCadets();
    cadets.splice(index, 1);
    saveCadets(cadets);
    displayCadets();
}

function displayCadets() {
    let cadets = getCadets();
    let tbody = document.querySelector("#cadetTable tbody");
    tbody.innerHTML = "";
    let marksArray = cadets.map(c => c.mark);
    let sortedMarks = [...marksArray].sort((a, b) => b - a);

    cadets.forEach((cadet, index) => {
        let gradeNumber = sortedMarks.indexOf(cadet.mark) + 1;

        let row = `
            <tr>
                <td>${cadet.name}</td>
                <td>${cadet.time}</td>
                <td>${cadet.mark}</td>
                <td>${cadet.rank}</td>
                <td>${gradeNumber}</td>
                <td>
                    <button onclick="editCadet(${index})">Edit</button>
                    <button onclick="deleteCadet(${index})">Delete</button>
                </td>
            </tr>
        `;
        tbody.innerHTML += row;
    });
}

function clearForm() {
    document.getElementById("name").value = "";
    document.getElementById("time").value = "";
    document.getElementById("mark").value = "";
    document.getElementById("rank").value = "";
}
</script>

</body>
</html>