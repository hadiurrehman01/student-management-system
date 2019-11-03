<template>
    <video ref="video" width="700" height="500">

    </video>
</template>
<script>
    export default {
        name: "webcam",
        data (){
            return {
                faceMode : 'environment',
                faceMode2 : 'user',
                stream : null
            }
        },
        mounted(){
            this.$nextTick(() => {
                this.startVideo();
            })
        },
        watch : {
            faceMode : {
                handler : function (val) {
                    this.stopVideo();
                    setTimeout(() => {
                        this.startVideo();
                    }, 2000);
                },
                deep : true
            }
        },
        methods : {
            startVideo(){
                let constraints = { 
                    facingMode : this.faceMode,
                    video: { 
                            width: 1280, 
                            height: 720,
                            facingMode : this.faceMode
                    } 
                }; 
                console.log(constraints);
                navigator.mediaDevices.getUserMedia(constraints)
                .then(function(mediaStream) {
                    let video = document.querySelector('video');
                    this.stream = mediaStream;
                    video.srcObject = this.stream;
                    video.onloadedmetadata = function(e) {
                        video.play();
                    };
                }.bind(this))
                .catch(function(err) { 
                    console.log(err.name + ": " + err.message);
                    this.$store.state.error = true;
                 }.bind(this));
            },
            catupreFrame(){
                    // add canvas element
                    const canvas = document.createElement('canvas');
                    document.querySelector('body').appendChild(canvas);

                    // set canvas dimensions to video ones to not truncate picture
                    const videoElement = document.querySelector('video');
                    canvas.width = videoElement.width;
                    canvas.height = videoElement.height;

                    // copy full video frame into the canvas
                    canvas.getContext('2d').drawImage(videoElement, 0, 0, videoElement.width, videoElement.height);

                    // get image data URL and remove canvas
                    const snapshot = canvas.toDataURL("image/png");
                    this.$store.state.proof = snapshot;
                    canvas.parentNode.removeChild(canvas);
            },
            stopVideo(){
                this.stream.getTracks().forEach(function(track) {
                    track.stop();
                });
            }
        },
        beforeDestroy: function(){
            this.stopVideo();
        }
    }
</script>