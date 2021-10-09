import Axios from 'axios'
import { without } from 'lodash'
export default {
    data () {
        return {
            form : {
                body : '',
                media : []
            },
            media : {
                'images' : [],
                'video' : null,
                'progress' : 0
            },
            mediaTypes : {}
        }
    },

    methods : {
        async submit () {
            if( this.media.images.length || this.media.video ) {
                let media = await this.uploadMedia();
                this.form.media = media.data.data.map( medium => medium.id );
            }
            await this.post()
            this.form.body = ''
            this.form.media = [];
            this.media.images = [];
            this.media.video = null;
            this.media.progress = 0;
        },
        handleUploadProgress (event) {
            this.progress = parseInt( Math.round( event.loaded / event.total ) * 100 )
        },
        async uploadMedia () {
            return await Axios.post('/api/media', this.buildMediaForm(), {
                header : {
                    'Content-Type' : 'multipart/form-data'  
                },
                onUploadProgress : this.handleUploadProgress
            })
        },
        buildMediaForm () {
            let form = new FormData();
            if(this.media.images.length){
                this.media.images.forEach( (image, index) => {
                    form.append(`media[${index}]`, image)
                })
            }
            if (this.media.video) {
                form.append(`media[0]`, this.media.video)
            }
            return form;
        },
        async getMediaTypes () {
            let response = await Axios.get('api/media/types')
            this.mediaTypes = response.data.data;
        },
        handleMediaSelected (files) {
            Array.from(files).slice(0, 4).forEach( (file) => {

                if(this.mediaTypes.image.includes(file.type)){
                    this.media.images.push(file);
                }

                if(this.mediaTypes.video.includes(file.type)){
                    this.media.video = file;
                }
            })

            if (this.media.video) {
                this.media.images = [];
            }
        },
        removeImage (image) {
            this.media.images = without( this.media.images, image )
        },
        removeVideo () {
            this.media.video = null
        }
    },
    mounted () {
        this.getMediaTypes();
    }
}