## Installation

1. Make sure php 7.4 is installed
2. Create `.env.local` in the project root. Put correct `API_CLIENT_*` variables in there.
3. `composer run install-demo`

## Usage

### Fetch posts

`composer run fetch-posts`

### Show Stat
    
`composer run show-stats`

## Troubleshooting

Docker container deployment may take some time to create the DB.
So if some scripts are run right after installation is done you would be able to see some PDO errors.
Please wait some time before running fetch or stat commands.
