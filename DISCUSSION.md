## Section 1 Documentation:
    1. Created a local .env file from .env.example.
    2. Identified and resolved an application startup issue. The project documentation states that the application should function without a database using hardcoded destination data; however, the default configuration attempted to use SQLite-backed sessions, resulting in a 500 error when the SQLite database file was not present. Resolved to function without DB until mySQL setup for Section 2.
    3. Added Laravel Pint to enforce consistent formatting. 
    4. Installed Larastan to provide static analysis and detect potential type and code issues during development
    5. Added Composer scripts to simplify common development tasks such as formatting and static analysis.
    5. Added a GitHub Actions CI workflow
    6. Configured the CI workflow to install php and node dependencies, build frontend assets, validate formatting with Pint and run analysis with Larastan.

    These changes help establish the foundation for a more production ready development workflow improving onboarding, enforcing code quality standards, and offering automated validation via CI.

## Section 2 Documentation:
    1. Configured the application to use MySQL and switched the utilized destination data from hardcoded arrays to the database.
    2. Fixed migration issues and updated the Destination model with fillable attributes and type casts.
    3. Updated DestinationExplorer to load from Eloquent
    4. Added search, sort, pagination, and an endpoint for individual destinations. 

## Section 3 Documentation:
    1. Improved search functionality to support case-insensitive matching across destination name, country, region, cost level, and activities.
    2. Changed usort function in DestinationExplorer to use spaceship operator for cleaner behavior
    3. Added :void return type for non-return functions in DestinationExplorer
    4. Revamped the blade to display the header/ search and destinations as hero & cards rather than a table and added styling to look more polished
    5. Added a sort by option to UI

    
## Section 4 Documentation:
    1. I secured administrative endpoints (seed endpoint) with Sanctum 
    2. Updated user.php to use Sanctum
    3. Tested creating a user and token via tinker then running 
	the seed POST call in bash with and without a token to confirm the call received a 401 without a token


## With More Time

- Add a config flag to swap between database data and hardcoded data. The API currently returns an Eloquent paginated query, so the hardcoded array data would need a different response path. This would also eliminate the need for commenting out the code for the unused hardcoded data functions in order to prevent that code from being seen as dead code by Larastan.
- Add destination photos to the UI.
- Add toggle for light/dark mode.
- Enhance the CI pipline with additional validation/tests
- Build a full authentication system with admin roles that can create, edit, and delete destinations, and read only access for standard users.
- Add a dropdown selector to change the number of destinations shown per page.
- Make each destination card clickable and route to an individual destination detail page/API endpoint with more information.


