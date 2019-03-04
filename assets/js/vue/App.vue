<template>
    <div id="main">
        <!--<Navbar></Navbar>-->
        <HeaderText></HeaderText>
        <GoForm></GoForm>
    </div>
</template>

<script>
    import Navbar from "./Navbar";
    import HeaderText from "./HeaderText";
    import GoForm from "./GoForm";
    export default {
        name: 'app',
        components: {GoForm, HeaderText, Navbar},
    }
</script>