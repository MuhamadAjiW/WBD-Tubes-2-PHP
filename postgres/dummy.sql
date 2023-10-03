--
-- PostgreSQL database dump
--

-- Dumped from database version 14.9
-- Dumped by pg_dump version 14.9

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: books; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.books (
    book_id integer NOT NULL,
    title character varying(256) NOT NULL,
    author_id integer NOT NULL,
    genre character varying(256) NOT NULL,
    release_date date NOT NULL,
    word_count integer NOT NULL,
    duration integer NOT NULL,
    graphic_cntn boolean NOT NULL,
    image_path character varying(256) NOT NULL,
    audio_path character varying(256) NOT NULL
);


ALTER TABLE public.books OWNER TO postgres;

--
-- Name: books_book_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.books_book_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.books_book_id_seq OWNER TO postgres;

--
-- Name: books_book_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.books_book_id_seq OWNED BY public.books.book_id;


--
-- Name: reviews; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reviews (
    book_id integer NOT NULL,
    user_id integer NOT NULL,
    rating integer NOT NULL,
    reviewtext character varying(2048) DEFAULT ''::character varying NOT NULL,
    CONSTRAINT reviews_rating_check CHECK (((rating >= 1) AND (rating <= 5)))
);


ALTER TABLE public.reviews OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    user_id integer NOT NULL,
    email character varying(256) NOT NULL,
    username character varying(256) NOT NULL,
    password character varying(256) NOT NULL,
    name character varying(256) NOT NULL,
    bio character varying(2048) DEFAULT ''::character varying NOT NULL,
    admin boolean DEFAULT false NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_user_id_seq OWNER TO postgres;

--
-- Name: users_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_user_id_seq OWNED BY public.users.user_id;


--
-- Name: books book_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.books ALTER COLUMN book_id SET DEFAULT nextval('public.books_book_id_seq'::regclass);


--
-- Name: users user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN user_id SET DEFAULT nextval('public.users_user_id_seq'::regclass);


--
-- Data for Name: books; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.books (book_id, title, author_id, genre, release_date, word_count, duration, graphic_cntn, image_path, audio_path) FROM stdin;
1	Judul Buku 1	1	Fiksi	2023-10-03	100000	120	t	src="/storage/images/image1.jpg	src="/storage/audio/audio1.txt
2	Judul Buku 2	2	Non-Fiksi	2023-10-04	80000	90	f	src="/storage/images/image2.jpg	src="/storage/audio/audio2.txt
3	Judul Buku 3	3	Fiksi	2023-10-05	120000	150	t	src="/storage/images/image3.jpg	src="/storage/audio/audio3.txt
4	Judul Buku 4	1	Fiksi	2023-10-06	90000	110	f	src="/storage/images/image4.jpg	src="/storage/audio/audio4.txt
5	Judul Buku 5	2	Non-Fiksi	2023-10-07	75000	80	t	src="/storage/images/image5.jpg	src="/storage/audio/audio5.txt
6	Judul Buku 6	3	Fiksi	2023-10-08	110000	130	f	src="/storage/images/image6.jpg	src="/storage/audio/audio6.txt
7	Judul Buku 7	1	Fiksi	2023-10-09	95000	100	t	src="/storage/images/image7.jpg	src="/storage/audio/audio7.txt
8	Judul Buku 8	2	Non-Fiksi	2023-10-10	85000	95	f	src="/storage/images/image8.jpg	src="/storage/audio/audio8.txt
9	Judul Buku 9	3	Fiksi	2023-10-11	105000	125	t	src="/storage/images/image9.jpg	src="/storage/audio/audio9.txt
10	Judul Buku 10	1	Fiksi	2023-10-12	80000	90	f	src="/storage/images/image10.jpg	src="/storage/audio/audio10.txt
\.


--
-- Data for Name: reviews; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.reviews (book_id, user_id, rating, reviewtext) FROM stdin;
3	3	5	Wah bagus sekali ya
4	4	5	Wah bagus sekali ya
5	5	5	Wah bagus sekali ya
10	10	5	Wah bagus sekali ya
6	6	4	Good book!
7	7	4	Good book!
8	8	4	Good book!
9	9	4	Good book!
1	1	3	Hmm B aja
2	2	3	Hmm B aja
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (user_id, email, username, password, name, bio, admin) FROM stdin;
1	user1@example.com	user1	$2y$10$SNWjT9X0rK.KG7dX59P9b.8q1lYSVW6oLL73nC3KVrmaD.6ZX6Dau	User Satu	Bio User Satu	f
2	user2@example.com	user2	$2y$10$zhAt8pub4zlidaL7hLEXmuErErc18KTV5viPnAD2BFllBxvBicg8e	User Dua	Bio User Dua	f
3	user3@example.com	user3	$2y$10$CsZsKilKRCxJixreSlZTbepS8Sn3uate9gc9ghREkUPV0CgcZLF7e	User Tiga	Bio User Tiga	f
4	user4@example.com	user4	$2y$10$EAM1XxQoJjnIgMPjKpapOumtp0cl5KZtzSUA/KhVqh2vroH9h2n1K	User Empat	Bio User Empat	f
5	user5@example.com	user5	$2y$10$AwgrWIVwKtCXe8FTaVfwd.9uMuv6Jz7aEZrHAGDmfr9hIxGKjYIwe	User Lima	Bio User Lima	f
6	user6@example.com	user6	$2y$10$qMqRPMgkTx2U5DkINGYBhe8CI2m.Bqdp.mk9EUsialndJsOs6ICZG	User Enam	Bio User Enam	f
7	user7@example.com	user7	$2y$10$stsfr9qjAPkFyFf.3E4NrOXNnX5UV2TPxTDKIBDmB.GKUGaK.EXx.	User Tujuh	Bio User Tujuh	f
8	user8@example.com	user8	$2y$10$pbZTvl8tBJxd11cyJDzN0eFS/QsJsdwQ5wOJq6wwOf4iJfwMTsLzm	User Delapan	Bio User Delapan	f
9	admin1@example.com	admin1	$2y$10$biivvP7SPeFKfWRHBNY/5uM17szL9MVcgYd84LZ.64MMdtvfJc2BO	Admin Satu	Bio Admin Satu	t
10	admin2@example.com	admin2	$2y$10$VN53EzMndNV223kiLr0ZI.coSS7b5EExZAVIhGZcKiUYXl4VDJcM6	Admin Dua	Bio Admin Dua	t
\.


--
-- Name: books_book_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.books_book_id_seq', 10, true);


--
-- Name: users_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_user_id_seq', 10, true);


--
-- Name: books books_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.books
    ADD CONSTRAINT books_pkey PRIMARY KEY (book_id);


--
-- Name: reviews reviews_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT reviews_pkey PRIMARY KEY (book_id, user_id);


--
-- Name: users users_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (user_id);


--
-- Name: users users_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);


--
-- Name: books books_author_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.books
    ADD CONSTRAINT books_author_id_fkey FOREIGN KEY (author_id) REFERENCES public.users(user_id);


--
-- Name: reviews reviews_book_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT reviews_book_id_fkey FOREIGN KEY (book_id) REFERENCES public.books(book_id);


--
-- Name: reviews reviews_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT reviews_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(user_id);


--
-- PostgreSQL database dump complete
--

