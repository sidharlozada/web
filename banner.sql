--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.9
-- Dumped by pg_dump version 9.3.7
-- Started on 2019-06-05 17:19:29 VET

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- TOC entry 2019 (class 0 OID 653747268)
-- Dependencies: 170
-- Data for Name: banner; Type: TABLE DATA; Schema: public; Owner: puser
--

INSERT INTO banner VALUES (6, ' ', ' ', '46db386d3d038359fa37b1f4c4291c45.jpg', 1, 0, 1, NULL);
INSERT INTO banner VALUES (7, ' ', ' ', '408661ec480f1fafaf850bd35124a559.jpg', 1, 0, 1, NULL);
INSERT INTO banner VALUES (8, ' ', ' ', '4b5c96668d43b6cfe34883f7c5f216e0.jpg', 1, 0, 1, NULL);
INSERT INTO banner VALUES (9, ' ', ' ', 'c6a9a155d89b8c4a82b3fc00d17456e4.jpg', 1, 0, 1, NULL);
INSERT INTO banner VALUES (10, ' ', ' ', '57e38a530cb3b18405afe72fd751dff3.jpg', 1, 0, 1, NULL);


--
-- TOC entry 2025 (class 0 OID 0)
-- Dependencies: 171
-- Name: banner_id_seq; Type: SEQUENCE SET; Schema: public; Owner: puser
--

SELECT pg_catalog.setval('banner_id_seq', 10, true);


-- Completed on 2019-06-05 17:19:30 VET

--
-- PostgreSQL database dump complete
--

