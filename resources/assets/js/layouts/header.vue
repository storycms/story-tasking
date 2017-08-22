<template>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Project name</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><router-link to="/dashboard">Dashboard</router-link></li>
          <li><router-link to="/project">Project</router-link></li>
        </ul>
      </div>
    </div>
  </nav>
</template>
