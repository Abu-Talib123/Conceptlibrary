'use strict';

const Hapi = require('@hapi/hapi');
 const execFile = require('child_process').execFile;
  var ffmpeg = require('ffmpeg');
const init = async () => {

    const server = Hapi.server({
        port: 3000,
        host: 'conceptlibrary.in'
    });

    server.route({
        method: 'GET',
        path: '/video/watermark',
        handler: (request, h) => {
        	const name =  request.query.a;
        	const video_file_name = request.query.video_file_name;
        	if(video_file_name && name) {
               
                   
                    return new Promise((resolve, reject) => {
                         var process = new ffmpeg('./includes/adminpanel/videocourse/'+video_file_name);
                    process.then(function (video) {
                        // Callback mode
                        video.fnAddWatermark('./includes/adminpanel/text_img/'+name, './includes/adminpanel/videocourse/user/'+video_file_name, {
                            position : 'SE'
                            }, function (error, file) {
                                if (!error) {
                                    resolve(file)
                                }else {
                                    console.log('Error 1: ' + error);
                                    reject(error)
                                }
                            });
                        }, function (err) {
                                console.log('Error 2: ' + err);
                                reject(err)
                        });
                    }).then((err) => {
                            throw new Error(err);
                                
                            console.log('Do this');
                        }).catch((err) => {
                            console.log('Error 3: ' + err);
                             throw new Error(err);
                        }); ; //return end;
                
        	}else {
                return 'invalid format';
            }
        }
    },
    {
        method: 'GET',
        path: '/watermark',
        handler: (request, h) => {
            const name =  request.query.a;
        	const video_file_name = request.query.video_file_name;
        	if(video_file_name && name) {
                try {
                    var process = new ffmpeg('./includes/adminpanel/videocourse/'+video_file_name);
                    process.then(function (video) {
                        // Callback mode
                        video.fnAddWatermark('./includes/adminpanel/text_img/'+name+'.png', './includes/adminpanel/videocourse/'+video_file_name+'-'+name+'.mp4', {
                            position : 'SE'
                        }, function (error, file) {
                            if (!error)
                                return file;
                        });
                    }, function (err) {
                        console.log('Error: ' + err);
                        return err;
                    });
                } catch (e) {
                    console.log(e.code);
                    return e.msg;
                }
        	}else {
                return 'invalid format';
            }

        }
    });

    await server.start();
    console.log('Server running on %s', server.info.uri);
};

process.on('unhandledRejection', (err) => {

    console.log(err);
    process.exit(1);
});

init();