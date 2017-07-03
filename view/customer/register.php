<div class="container">
	<form action="<?= URL ?>customer/createSave" method="post">
        <strong>Username</strong>
        <br />
        <input type="text" name="username">    
		<br />
		
		<strong>Password:</strong>
		<br />
		<input type="password" name="password">
		<br />
		
		<strong>Firstname:</strong>
		<br />
		<input type="text" name="firstname">
		<br />
		
		<strong>Lastname:</strong>
		<br />
		<input type="text" name="lastname">
		<br />
		
		<strong>Email:</strong>
		<br />
		<input type="email" name="email">
		<br />
		
		<strong>Address:</strong>
		<br />
		<input type="text" name="address">
		<br />
		
		<strong>Postalcode:</strong>
		<br />
		<input type="text" name="postalcode">
		<br />
		
		<strong>City</strong>
		<br />
		<input type="text" name="city">
		<br />
		
		<strong>Mobile Number:</strong>
		<br />
		<input type="text" name="mobile">
        <br />
        
        <br />
		<input type="submit" value="Register">
	</form>
</div>