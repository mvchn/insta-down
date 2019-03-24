<template>
    <div id="main">
        <!--<Navbar></Navbar>-->
        <!--<HeaderText></HeaderText>-->
        <GetLinkForm></GetLinkForm>
    </div>
</template>

<script>
    import GetLinkForm from "./GetLinkForm";
    export default {
        name: 'app',
        components: {GetLinkForm},
    }
</script>