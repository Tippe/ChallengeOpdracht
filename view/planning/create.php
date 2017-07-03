<div class="container">
	<form action="<?= URL ?>planning/createSave" method="post">
        <strong>Employee</strong>
        <br />
        <input type="text" name="employee">    
		<br />
		
		<strong>Date:</strong>
		<br />
		<input type="text" name="date">
		<br />
		
		<strong>Start Time:</strong>
		<br />
		<input type="text" name="start_time">
		<br />
		
		<strong>End Time:</strong>
		<br />
		<input type="text" name="end_time">
		<br />
		
		<strong>Customer:</strong>
		<br />
		<input type="text" name="customer">
		<br />
		
		<strong>Reserved:</strong>
		<br />
		<input type="text" name="reserved">
		<br />
		
		<strong>Status:</strong>
		<br />
		<input type="text" name="status">
		<br />
		
		<br />
		<input type="submit" value="Make Appointment">
	</form>
</div>