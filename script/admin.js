const firebaseConfig = {
    apiKey: "AIzaSyAKyak_Tw2mRIyYj2f7uUXaz0qml9S2mBk",
    authDomain: "ptracking-89393.firebaseapp.com",
    databaseURL: "https://ptracking-89393-default-rtdb.firebaseio.com",
    projectId: "ptracking-89393",
    storageBucket: "ptracking-89393.appspot.com",
    messagingSenderId: "698946787774",
    appId: "1:698946787774:web:a363c4e9b705ea5b0981ef"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const database = firebase.database();

// Admin Page - Add Package
const packageForm = document.getElementById('package-form');
packageForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const trackingNumber = document.getElementById('tracking-number').value;
    const name = document.getElementById('name').value;
    const location = document.getElementById('location').value;
    const status = document.getElementById('status').value;

    // Push data to Firebase
    database.ref('packages/' + trackingNumber).set({
        name: name,
        location: location,
        status: status
    });
    alert('Package added successfully!');
    packageForm.reset();
});

// Display Packages in Table
const packageTableBody = document.getElementById('package-table-body');
database.ref('packages').on('value', (snapshot) => {
    packageTableBody.innerHTML = ''; // Clear previous data
    snapshot.forEach((childSnapshot) => {
        const packageData = childSnapshot.val();
        const trackingNumber = childSnapshot.key;
        const row = `<tr data-id="${trackingNumber}">
                        <td>${trackingNumber}</td>
                        <td>${packageData.name}</td>
                        <td>${packageData.location}</td>
                        <td>${packageData.status}</td>
                        <td>
                            <button onclick="editPackage('${trackingNumber}')">Edit</button>
                            <button onclick="deletePackage('${trackingNumber}')">Delete</button>
                        </td>
                    </tr>`;
        packageTableBody.innerHTML += row;
    });
});

// CRUD Operations
function editPackage(trackingNumber) {
    const name = prompt('Enter new name:');
    const location = prompt('Enter new location:');
    const status = prompt('Enter new status:');
    database.ref('packages/' + trackingNumber).update({
        name: name,
        location: location,
        status: status
    });
}

function deletePackage(trackingNumber) {
    if (confirm('Are you sure you want to delete this package?')) {
        database.ref('packages/' + trackingNumber).remove();
    }
}

// admin css
$(document).ready(()=>{
  
    $('#open-sidebar').click(()=>{
       
        // add class active on #sidebar
        $('#sidebar').addClass('active');
        
        // show sidebar overlay
        $('#sidebar-overlay').removeClass('d-none');
      
     });
    
    
     $('#sidebar-overlay').click(function(){
       
        // add class active on #sidebar
        $('#sidebar').removeClass('active');
        
        // show sidebar overlay
        $(this).addClass('d-none');
      
     });
    
  });