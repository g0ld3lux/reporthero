<template>
<date-picker :date.sync="date" :option="option" :limit="limit">
</template>

<script>
import datePicker from 'vue-datepicker'
export default {
    props: {
            date: {
                type: Object,
                default() {
                    return {
                        time: moment().format('YYYY-MM-DD')
                    }
                }
               
            },
           
            placeholder: {
                type: String,
                default() {
                    return 'Pick A Date'
                }
            },
            type: {
                type: String,
                default() {
                    return 'day'
                }
            },
            format: {
                type: String,
                default() {
                    return 'YYYY-MM-DD'
                }
            },
            inputStyle: {
                type: Object,
                default() {
                    return {
                    'display': 'inline-block',
                    'padding': '12px',
                    'line-height': '22px',
                    'font-size': '16px',
                    'border': '2px solid #fff',
                    'box-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.2)',
                    'text-align': 'center',
                    'border-radius': '2px',
                    // Color of Text in Input
                    'color': '#ffd54f'
                    }
                }
            },
            color: {
                type: Object,
                default() {
                    return {
                    header: '#ffca28',
                    headerText: '#eceff1'
                    }
                }
            },
            buttons: {
                type: Object,
                default() {
                    return {
                    ok: 'Ok',
                    cancel: 'Cancel'
                    }
                }
            },
            dismissible: {
                type: Boolean,
                default() {
                    return true
                }
            },
            limitFrom: {
                type: String,
                // Override With The Created Date of A Campaign
                default() {
                    return moment().subtract(30,'d').format('YYYY-MM-DD')
                }
            },
            limitTo: {
                type: String,
                // Usual is Current Date , but Can Be Override
                default() {
                    return moment().format('YYYY-MM-DD')
                }
            }
            
    },
    data() {
        return {

            option: {
                type: this.type,
                week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                format: this.format,
                placeholder: this.placeholder,
                inputStyle: this.inputStyle,
                color: this.color,
                buttons: this.buttons,
                overlayOpacity: 0.5,
                dismissible: this.dismissible
            },
            timeoption: {
                type: 'min',
                week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                format: 'YYYY-MM-DD HH:mm'
            },
            multiOption: {
                type: 'multi-day',
                week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                format:"YYYY-MM-DD HH:mm"
            },
            // add in vuex campaign module to set limit...
            limit: [{
                type: 'week',
                available: [1,2,3,4,5]
            },
            {
                type: 'fromto',
                // this should be pass as a props
                from: this.limitFrom,
                to: this.limitTo // Present Date
            }],
        }
    },
    components: {
        datePicker
    }

}
</script>

<style>
</style>