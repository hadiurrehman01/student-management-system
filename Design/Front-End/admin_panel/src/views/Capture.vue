<template>
    <div>
        <div v-if="$store.state.error">
            <h1 style="color: red"> Error Occured</h1>
        </div>
        <div v-else-if="$store.state.proof">
            <img :src="$store.state.proof" />
            <button @click="$store.state.proof = null" style="padding: 10px 20px; background-color:crimson; color:white">Retake</button>
        </div>
        <div v-else>
            <div>
                <webcam ref="refCam" />
            </div>
            <button @click="captureImage" style="padding: 10px 20px; background-color:crimson; color:white">Capture</button>
            <button @click="changeCamera" style="padding: 10px 20px; background-color:crimson; color:white">Change Camera</button>
        </div>
    </div>
</template>
<script>
    import webcam from './Webcam.vue'
    
    export default {
        name : "Capture",
        components : {
            webcam
        },
        mounted(){
            console.log(this.$refs.refCam);
        },
        methods : {
            captureImage(){
                this.$refs.refCam.catupreFrame();
            },
            changeCamera(){
                if(this.$refs.refCam.faceMode === 'environment'){
                    this.$refs.refCam.faceMode = 'user';
                } else {
                    this.$refs.refCam.faceMode = 'environment'   
                }
            }
        }
    }
</script>