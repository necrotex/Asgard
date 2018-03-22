<template>
    <div class="countdown">
        <div class="block">
            <p class="digit">{{ days | two_digits }}</p>
            <p class="text">Days</p>
        </div>
        <div class="block">
            <p class="digit">{{ hours | two_digits }}</p>
            <p class="text">Hours</p>
        </div>
        <div class="block">
            <p class="digit">{{ minutes | two_digits }}</p>
            <p class="text">Minutes</p>
        </div>
        <div class="block">
            <p class="digit">{{ seconds | two_digits }}</p>
            <p class="text">Seconds</p>
        </div>
    </div>
</template>

<script>
    var moment = require('moment');
    export default {
        mounted() {
            window.setInterval(() => {
                this.now = moment.utc().format('X');
            },1000);
        },
        props : {
            date : {
                coerce: str => moment.utc(this.date).format('X')
            }
        },
        data() {
            return {
                now: moment.utc().format('X'),
                timestamp: moment.utc(this.date).format('X')
            }
        },
        computed: {
            seconds() {
                return (this.timestamp - this.now) % 60;
            },
            minutes() {
                return Math.trunc((this.timestamp - this.now) / 60) % 60;
            },
            hours() {
                return Math.trunc((this.timestamp - this.now) / 60 / 60) % 24;
            },
            days() {
                return Math.trunc((this.timestamp - this.now) / 60 / 60 / 24);
            }
        }
    }
</script>