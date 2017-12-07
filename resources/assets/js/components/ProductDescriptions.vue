<template>
    <div class="form-group">
        <div class="row">
            <label for="desc_short"><input id="desc_short_check" type="checkbox" v-model="checked_short"/> Opis krótki (do 255 znaków):</label>
            <textarea id="desc_short" name="descriptions[desc_short]" rows="3" placeholder="Wpisz opis ..."
                      class="form-control" v-model="desc_short" :disabled="!checked_short" maxlength="255"></textarea>
            <br>
            <label for="desc_long"><input id="desc_long_check" type="checkbox"  v-model="checked_long"/> Opis długi:</label>
            <textarea id="desc_long" name="descriptions[desc_long]" rows="4" placeholder="Wpisz opis ..."
                      class="form-control" v-model="desc_long" :disabled="!checked_long"></textarea>
        </div>
    </div>
</template>
<script>


    export default {

        data() {
            return {
            desc_short: '',
            desc_long: '',
            checked_short : false,
            checked_long: false
            }
        },
    }
</script>