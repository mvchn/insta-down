<template>
    <div id="main">
        <!--<Navbar></Navbar>-->
        <HeaderText></HeaderText>
        <GetLinkForm></GetLinkForm>
    </div>
</template>

<script>
    import Navbar from "./Navbar";
    import HeaderText from "./HeaderText";
    import GetLinkForm from "./GetLinkForm";
    export default {
        name: 'app',
        components: {GetLinkForm, HeaderText, Navbar},
    }
</script>