<template>
    <div class="h-10 w-10">
        <svg class="transform -rotate-90" viewBox="0 0 120 120">
            <circle
                cx="60"
                cy="60"
                :r="radius"
                fill="none"
                stroke-width="8"
                class="stroke-current text-gray-700"
            />

            <circle
                cx="60"
                cy="60"
                :r="radius"
                fill="none"
                stroke-width="8"
                class="stroke-current"
                :stroke-dasharray="dash"
                :stroke-dashoffset="offset"
                :class="{
                    'text-red-500': percentageOverHundredPercentage,
                    'text-blue-500': !percentageOverHundredPercentage,
                }" 
            />
        </svg>
    </div>
</template>
<script>
export default {
    props : {
        body : {
            required : true,
            type : String
        }
    },
    data () {
        return {
            radius : 30
        }
    },
    computed : {
        dash () {
            return 2 * Math.PI * this.radius
        },
        displayPercentage () {
            return this.percentage <= 100 ? this.percentage : 100
        },
        percentageOverHundredPercentage () {
            return this.percentage > 100
        },
        percentage () {
            return Math.round((this.body.length * 100) / 280)
        },
        offset () {
            let circle = this.dash
            let progress = this.displayPercentage / 100
            return circle * ( 1 - progress )
        }
    }
}
</script>