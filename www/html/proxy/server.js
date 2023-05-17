'use strict';

const express = require('express');
const request = require('request');
const { URL } = require('url');
require('dotenv').config();
// var cookieParser = require('cookie-parser');
let cors = require('cors');
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


app.use(cors({
  origin: 'http://localhost:3000',
  credentials: true,
}));

const servers = {
  'default':'http://web_server',
  'arcsinus:test':'https://test:test@arcsinus.kant.ru',
  'p4':'https://p4.kant.ddp-dev.ru',
  'p5':'https://p5.kant.ddp-dev.ru',
  'ddp':'https://ddp.kant.ru/api',
  'spa':'https://spa.kant.ru',
  'arcsinus':'https://arcsinus.kant.ru',
}

app.all('*', (req, res) => {
  const uri = `${servers[process.env.SERVER]}/api/kant/v1${req.originalUrl}`;
  console.log(req.method, uri)

  if(String(req.method || '').toUpperCase() === 'OPTIONS'){
    res.set(optionsHeaders);
    res.send(); 
    return;
  }

  const newReq = request({
      uri,
      method: req.method,
    },
    function (error, response, body) {
      if (error) {
        return console.error('upload failed:', error);
      }
    }
  );

  const urlObject = new URL(uri);

  req.pipe(newReq).on('response', function (res) {
    if (res.headers['set-cookie']) {
      console.log(typeof res.headers['set-cookie'][0])
      res.headers['set-cookie'] = res.headers['set-cookie'].map(
        v => (typeof v.replaceAll !== "undefined") ?? v.replaceAll(urlObject.hostname, 'localhost') + '; SameSite=None; Secure'
      );
    }
    // res.headers['access-control-allow-origin'] = 'http://test.local.com:3000';
    res.headers['access-control-allow-origin'] = '*';
    // res.headers['Access-Control-Expose-Headers'] = 'Content-Length, Date, Server, Transfer-Encoding, Content-Disposition';

    // res.cookie('BITRIX_SM_SALE_UID', '2b42d74e00fc318bf4a2914ff1c72c08');
  }).pipe(res);
});

app.listen(8989, () => console.log('Example app listening on port 8989!'));
