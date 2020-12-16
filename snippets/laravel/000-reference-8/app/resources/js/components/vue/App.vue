<template>
    <div>
        <component1 :article="{}" :canModify="false"></component1>
    </div>
</template>

<script>
    import Component1 from "./Component1";

    export default {
        name: 'app',
        components: {
            Component1
        }
    }
</script>
