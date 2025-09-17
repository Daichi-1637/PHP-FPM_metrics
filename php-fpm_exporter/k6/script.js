import http from "k6/http";
import { sleep, check } from "k6";

export const options = {
  stages: [
    { duration: "10s", target: 100 },
    { duration: "60s", target: 0 },
    { duration: "120s", target: 3000 },
  ],
};

export default function () {
  const res = http.get(`http://${__ENV.HOST}:${__ENV.PORT}/?processing_time=120`);
  check(res, { 'response code was 200': (res) => res.status == 200 });
  sleep(1);
}
