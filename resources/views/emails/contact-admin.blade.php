<!DOCTYPE html>
<html>
<head>
    <title>New Contact Message</title>
</head>
<body>
    <h2>New Contact Message</h2>
    
    <p><strong>From:</strong> {{ $name }} ({{ $email }})</p>
    <p><strong>Subject:</strong> {{ $subject }}</p>
    
    <h3>Message:</h3>
    <p>{{ $message }}</p>
    
    <hr>
    <p>This message was sent from the contact form on your website.</p>
</body>
</html> 