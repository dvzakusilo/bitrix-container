'use strict';

const express = require('express');
const request = require('request');
// var cookieParser = require('cookie-parser');
var cors = require('cors');
const app = express();

const optionsHeaders = {
  'Access-Control-Expose-Headers': '*',
  'Access-Control-Allow-Credentials': 'true',
  'Access-Control-Max-Age': '3600',
  'Access-Control-Allow-Origin': '*',
  'Access-Control-Allow-Headers': '*',
  'Access-Control-Allow-Methods': '*',
  'Connection': 'keep-alive',
  'Access-Control-Request-Method': 'POST',
  'Allow': 'GET, POST, PUT, DELETE, OPTIONS, HEAD',
  'Allowed': 'GET, POST, PUT, DELETE, OPTIONS, HEAD',
  'Content-Length': 0,
};

// app.use(cookieParser());
app.use(cors({
  origin: 'http://localhost:3000',
  credentials: true,
}));

app.all('*', (req, res) => {
   const url = `http://localhost/api/kant/v1${req.originalUrl}`;
  // const url = `https://test:test@arcsinus.kant.ru/api/kant/v1${req.originalUrl}`;
  // const url = `https://p4.kant.ddp-dev.ru/api/kant/v1${req.originalUrl}`;
   // const url = `https://ddp.kant.ru/api/kant/v1${req.originalUrl}`;
  // const url = `https://p5.kant.ddp-dev.ru/api/kant/v1${req.originalUrl}`;
  // const url = `https://spa.kant.ru/api/kant/v1${req.originalUrl}`
  // const url = `https://arcsinus.kant.ru/api/kant/v1${req.originalUrl}`;
  console.log(req.method, url)

  if(String(req.method || '').toUpperCase() === 'OPTIONS'){
    res.set(optionsHeaders);
    res.send(); 
    return;
  }

  const newReq = request({
      url,
      method: req.method,
    },
    function (error, response, body) {
      if (error) {
        return console.error('upload failed:', error);
      }
    }
  );

  req.pipe(newReq).on('response', function (res) {
    if (res.headers['set-cookie']) {
      console.log(typeof res.headers['set-cookie'][0])
      res.headers['set-cookie'] = res.headers['set-cookie'].map(
        v => v.replaceAll(`p4.kant.ddp-dev.ru`, 'localhost') + '; SameSite=None; Secure'
      );
    }
    // res.headers['access-control-allow-origin'] = 'http://test.local.com:3000';
    // res.headers['access-control-allow-origin'] = 'http://localhost:8888';
    // res.headers['Access-Control-Expose-Headers'] = 'Content-Length, Date, Server, Transfer-Encoding, Content-Disposition';

    // res.cookie('BITRIX_SM_SALE_UID', '2b42d74e00fc318bf4a2914ff1c72c08');
  }).pipe(res);
});

app.listen(8989, () => console.log('Example app listening on port 8989!'));
