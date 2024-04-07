<script >
fetch('fetch_scholarships.php')
  .then(response => response.json())
  .then(data => {
    // Process the fetched data
    console.log(data);
  })
  .catch(error => {
    console.error('Error fetching scholarship information:', error);
  });
  </script>
  
