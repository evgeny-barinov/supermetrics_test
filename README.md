## Installation

1. Make sure php 7.4 is installed
2. Create `.env.local` in the project root. Put correct `API_CLIENT_*` variables in there.
3. `composer run install-demo`

## Usage

1. Run [Load Posts Metrics Command](### Load Posts Metrics) command to load everything
2. Run [Show Stats Command](### Show Stats) to display metrics

## Commands

### Show Stats
    
`composer run show-stats`

### Load Posts Metrics

`compser run load-posts-metrics`

## Troubleshooting

Docker container deployment may take some time to create the DB.
So if some scripts are run right after installation is done you would be able to see some PDO errors.
Please wait some time (I expereinced 1-2 minutes) before running fetch or stat commands.
