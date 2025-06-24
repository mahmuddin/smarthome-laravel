<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $tenant_id
 * @property string $domain
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Tenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Domain withoutTrashed()
 */
	class Domain extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $database
 * @property string|null $email
 * @property array<array-key, mixed>|null $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Domain> $domains
 * @property-read int|null $domains_count
 * @method static \Spatie\Multitenancy\TenantCollection<int, static> all($columns = ['*'])
 * @method static \Spatie\Multitenancy\TenantCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant whereDatabase($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Tenant withoutTrashed()
 */
	class Tenant extends \Eloquent {}
}

namespace App\Models\Tenant{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tenant\AutomationAction> $actions
 * @property-read int|null $actions_count
 * @property-read \App\Models\Tenant\Home|null $home
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tenant\AutomationRule> $rules
 * @property-read int|null $rules_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Automation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Automation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Automation query()
 */
	class Automation extends \Eloquent {}
}

namespace App\Models\Tenant{
/**
 * 
 *
 * @property-read \App\Models\Tenant\Automation|null $automation
 * @property-read \App\Models\Tenant\Device|null $device
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutomationAction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutomationAction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutomationAction query()
 */
	class AutomationAction extends \Eloquent {}
}

namespace App\Models\Tenant{
/**
 * 
 *
 * @property-read \App\Models\Tenant\Automation|null $automation
 * @property-read \App\Models\Tenant\Device|null $device
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutomationRule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutomationRule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AutomationRule query()
 */
	class AutomationRule extends \Eloquent {}
}

namespace App\Models\Tenant{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tenant\DeviceLog> $logs
 * @property-read int|null $logs_count
 * @property-read \App\Models\Tenant\Room|null $room
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Device newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Device query()
 */
	class Device extends \Eloquent {}
}

namespace App\Models\Tenant{
/**
 * 
 *
 * @property-read \App\Models\Tenant\Device|null $device
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DeviceLog query()
 */
	class DeviceLog extends \Eloquent {}
}

namespace App\Models\Tenant{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tenant\Automation> $automations
 * @property-read int|null $automations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tenant\Room> $rooms
 * @property-read int|null $rooms_count
 * @property-read \App\Models\Tenant\TenantUser|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Home newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Home newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Home query()
 */
	class Home extends \Eloquent {}
}

namespace App\Models\Tenant{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tenant\Device> $devices
 * @property-read int|null $devices_count
 * @property-read \App\Models\Tenant\Home|null $home
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Room query()
 */
	class Room extends \Eloquent {}
}

namespace App\Models\Tenant{
/**
 * 
 *
 * @property-read \App\Models\Tenant\Device|null $device
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Schedule query()
 */
	class Schedule extends \Eloquent {}
}

namespace App\Models\Tenant{
/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tenant\Home> $homes
 * @property-read int|null $homes_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenantUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenantUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TenantUser query()
 */
	class TenantUser extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 */
	class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject {}
}

