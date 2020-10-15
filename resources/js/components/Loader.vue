<template>
    <div class="loader-cover">
      <div class="loader"></div>
    </div>
</template>

<script>
export default {
  
}
</script>

<style lang="css">
  .loader-cover{
    width: 100%;
    position: fixed;
    top: 0;
    bottom: 0;
    background-color: rgba(84, 76, 76, 0.3);
    z-index: 999999;
    left: 0;
  }

  .loader-cover > .container-fluid, .loader-cover > .container-fluid > .row{
    height: 100%;
  }

  .loader {
      border: 16px solid #f3f3f3; /* Light grey */
      border-top: 16px solid rgba(204,97,15,1); /* Blue */
      border-radius: 50%;
      width: 120px;
      height: 120px;
      animation: spin 2s linear infinite;
      position: absolute;
      left: 45%;
      top: 45%;
  }

  @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
  }
</style>