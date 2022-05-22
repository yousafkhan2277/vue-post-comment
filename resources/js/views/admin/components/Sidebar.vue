<template>
    <ul
      class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
      id="accordionSidebar"
    >
      <!-- Sidebar - Brand -->
      <router-link
        class="sidebar-brand d-flex align-items-center justify-content-center"
        to="/"
      >
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Home</div>
      </router-link>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

     



      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <router-link class="nav-link" to="/admin">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Profile</span></router-link
        >
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />

       <!-- Nav Item - Dashboard -->
      <li class="nav-item active ">
        <router-link class="nav-link" to="/admin/pages/posts">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Post</span></router-link
        >
      </li>



            <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
          <a
            class="nav-link"
            @click="logout"
          >
            <i class="fas fa-sign-out-alt "></i>
           <span>Logout</span>
          </a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider" />
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->
</template>

<script>

export default {
  name: "Sidebar",
  methods: {
    logout() {
      localStorage.removeItem("token");
      this.$store.dispatch("user", null);
      this.$router.push("/login");
    },
  },
};
</script>



