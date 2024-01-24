# Jukebox
## Jukebox CLI

### Prerequisites

To install and run the API you need [Docker Compose](docker-compose)
Please follow the [official documentation](docker-compose-install) to install it on your environment.

### Install


```bash
git clone git@github.com:lechatquidanse/jukebox.git
```
then 

```bash
make install
```
then after few seconds (waiting for db to be ready)
```bash
make migrate-database
```

### Features
#### Populate jukebox

```bash
make populate-jukebox
```
#### List

```bash
make list
```
#### Play

```bash
make play
```
or 

```bash
make play TRACK_NUMBERS="1 2"
```
#### Queue

```bash
make queue
```

### Next steps

- Add doctrine ORM to persist in MySQL rather than in Memory