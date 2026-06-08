<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Rental Ticket</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #0f0f2f;
      color: #e0e0ff;
      padding: 30px;
      border: 4px double #08f;
    }

    .ticket-container {
      background: linear-gradient(145deg, #10102b, #1a1a3f);
      border: 2px solid #0ff;
      border-radius: 10px;
      padding: 25px;
      box-shadow: 0 0 20px #0ff;
    }

    .ticket-title {
      font-size: 28px;
      color: #0ff;
      text-align: center;
      border-bottom: 1px dashed #0ff;
      margin-bottom: 20px;
      padding-bottom: 10px;
    }

    .ticket-section {
      margin-bottom: 15px;
    }

    .ticket-label {
      font-weight: bold;
      color: #8ef;
    }

    .ticket-footer {
      margin-top: 25px;
      padding-top: 15px;
      border-top: 1px dashed #0ff;
      text-align: center;
      color: #bbb;
      font-style: italic;
    }

    .highlight {
      color: #ff0;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="ticket-container">
    <div class="ticket-title">BorrowBuddy - Rental Ticket</div>

    <div class="ticket-section">
      <span class="ticket-label">Name:</span> <?= $data['user']['fullName'] ?>
    </div>
    <div class="ticket-section">
      <span class="ticket-label">Book:</span> <?= $data['book']['title'] ?>
    </div>
    <div class="ticket-section">
      <span class="ticket-label">Author:</span> <?= $data['book']['author'] ?>
    </div>
    <div class="ticket-section">
      <span class="ticket-label">Rental ID:</span> <?= $data['rental']['rentalId'] ?>
    </div>
    <div class="ticket-section">
      <span class="ticket-label">Rent Date:</span> <?= $data['rentalDate'] ?>
    </div>
    <div class="ticket-section">
      <span class="ticket-label">Due Date:</span> <span class="highlight"><?= $data['dueDate'] ?></span>
    </div>

    <div class="ticket-footer">
      Please present this ticket during walk-in collection and return at the library counter.<br>
      Secure | Paperless | Fast
    </div>
  </div>
</body>
</html>
