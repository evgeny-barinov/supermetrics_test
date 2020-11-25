## Installation

1. Make sure php 7.4 is installed
2. Create `.env.local` in the project root. Put correct `API_CLIENT_*` variables in there.
3. `composer run install-demo`

## Usage

1. Run **Load Posts Metrics** command to load everything
2. Run **Show Stats** command to display metrics

## Commands

### Load Posts Metrics

`composer run load-posts-metrics`

### Show Stats
    
`composer run show-stats`

## Third-party modules used

 - **symfony/console** - to use console interface
 - **symfony/http-client** - to implement API access easily
 - **symfony/dotenv** - to use ENV variable for saving sensitive details locally such as API credentials
 - **symfony/cache** - to save API token in a file system in this case
 - **lazyjsonmapper/lazyjsonmapper** - provides good abstractions for JSON 

## Troubleshooting

Docker container deployment may take some time to create the DB.
So if some scripts are run right after installation is done you would be able to see some PDO errors.
Please wait some time (I expereinced 1-2 minutes) before running fetch or stat commands.
