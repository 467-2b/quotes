<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
  border-right: 1px solid #bbb;
  font-size:20px;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

.active {
  background-color: #4CAF50;
}

li:last-child {
  border-right: none;
}

</style>

<header>
<ul>
    <li><a class="active" href="/">Home</a></li>
    <li><a href="/quotes">Quotes</a></li>
    <li><a href="/orders">Orders</a></li>
    <li><a href="/users">Users</a></li>
    <li><a href="/customers">Customers</a></li>
    <li style="float:right"><a class="active" href="/login">Sign In</a></li>
</ul>
</header>