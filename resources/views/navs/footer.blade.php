<style>

		footer {
  background-color: #f8f9fa;
  padding: 20px 0;
  font-family: Arial, sans-serif;
}

.footer-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

.footer-column {
  flex: 1;
  min-width: 200px;
  margin-bottom: 20px;
}

.footer-column h3 {
  color: #333;
  font-size: 18px;
  margin-bottom: 10px;
}

.footer-column ul {
  list-style-type: none;
  padding: 0;
}

.footer-column ul li {
  margin-bottom: 5px;
}

.footer-column ul li a {
  color: #666;
  text-decoration: none;
}

.footer-column form {
  display: flex;
}

.footer-column input[type="email"] {
  flex-grow: 1;
  padding: 5px;
  border: 1px solid #ccc;
}

.footer-column button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
}

.footer-bottom {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1200px;
  margin: 20px auto 0;
  padding: 20px 20px 0;
  border-top: 1px solid #ddd;
}

.payment-icons img {
  height: 20px;
  margin-right: 10px;
}

.language-selector select {
  padding: 5px;
  border: 1px solid #ccc;
}

@media (max-width: 768px) {
  .footer-container {
    flex-direction: column;
  }
  
  .footer-column {
    width: 100%;
  }
  
  .footer-bottom {
    flex-direction: column;
    text-align: center;
  }
  
  .footer-bottom > div {
    margin-bottom: 10px;
  }
}
</style>

<footer>
  <div class="footer-container">
    <div class="footer-column">
      <h3>STORE</h3>
      <ul>
        <li><a href="#">About us</a></li>
        <li><a href="#">Find store</a></li>
        <li><a href="#">Categories</a></li>
        <li><a href="#">Blogs</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h3>INFORMATION</h3>
      <ul>
        <li><a href="#">Help center</a></li>
        <li><a href="#">Money refund</a></li>
        <li><a href="#">Shipping info</a></li>
        <li><a href="#">Refunds</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h3>SUPPORT</h3>
      <ul>
        <li><a href="#">Help center</a></li>
        <li><a href="#">Documents</a></li>
        <li><a href="#">Account restore</a></li>
        <li><a href="#">My orders</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h3>NEWSLETTER</h3>
      <p>Stay in touch with latest updates about our products and offers</p>
      <form>
        <input type="email" placeholder="Email">
        <button type="submit">JOIN</button>
      </form>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="copyright">
      © 2024 Copyright: Mountain Artisan Collective.com
    </div>
    <!-- <div class="payment-icons">
      <img src="visa.png" alt="Visa">
      <img src="mastercard.png" alt="Mastercard">
      <img src="paypal.png" alt="PayPal">
    </div> -->
    <div class="language-selector">
      <select>
        <option>English</option>
      </select>
    </div>
  </div>
</footer>